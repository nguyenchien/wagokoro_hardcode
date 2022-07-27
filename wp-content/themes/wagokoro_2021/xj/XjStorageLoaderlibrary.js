//========================================================
//
// ■XJStorageLoaderクラス定義
//
//========================================================

if (!Array.prototype.indexOf) {
  Array.prototype.indexOf = function (elt /*, from*/ ) {
    var len = this.length;

    var from = Number(arguments[1]) || 0;
    from = (from < 0)
      ? Math.ceil(from)
      : Math.floor(from);
    if (from < 0)
      from += len;

    for (; from < len; from++) {
      if (from in this
        && this[from] === elt)
        return from;
    }
    return -1;
  };
}

(function () {

  /*========================================================
   コンストラクタ
  ========================================================*/
  XjStorageLoaderNews = function (s) {
    var defaults = {
      domain: '//www.xj-storage.jp',
      company: 'AS71125',
      pdf: '1',
      len: '',
      documents_all: '',
      documents_Kessan: '1,2,3,4,16,17,18,19,20,21',
      documents_Setsumei: '13,98',
      documents_Yuho: '99,105,106,107,108,1030,1040,1080,1090,1100,1120,1130,1135,1136,1140,1150,1160,1170,1180,1190,1200,1210,1220,1230,1235,1236,1240,1250,1260,1270,1280,1290,1300,1310,1320,1350,1360',
      documents_Sokai: '34,91,111,1900',
      documents_Tekizi: '0,5,6,8,9,15,24,25,28',
      documents_Other: '90,92,93,95,96,97,101,102,103,104,110,112,113,114,115,116,117,118,119,120'
    };

    this.settings = $.extend(defaults, s);
    this.fdate;
    this.pdate;
    this.documents;
    this.select_latest = '';
    this.select_oldest = '';

    this.ary_doc_no;
    this.ary_doc_Kessan;
    this.ary_doc_Setsumei;
    this.ary_doc_Yuho;
    this.ary_doc_Sokai;
    this.ary_doc_Tekizi;
    this.ary_doc_Other;

    XjStorageLoaderNews.prototype.init.call(this);
  };

  /*========================================================
   初期設定
  ========================================================*/
  XjStorageLoaderNews.prototype.init = function () {
    $.ajaxSetup({
      scriptCharset: 'utf-8'
    });

    //$.ajaxSetup({scriptCharset:'shift_jis'});
    this.ary_doc_Kessan = this.settings.documents_Kessan.split(",")
    this.ary_doc_Setsumei = this.settings.documents_Setsumei.split(",");
    this.ary_doc_Yuho = this.settings.documents_Yuho.split(",");
    this.ary_doc_Sokai = this.settings.documents_Sokai.split(",");
    this.ary_doc_Tekizi = this.settings.documents_Tekizi.split(",");
    this.ary_doc_Other = this.settings.documents_Other.split(",");

    //全部
    this.settings.documents_all =
      this.settings.documents_Kessan + ','
      + this.settings.documents_Setsumei + ','
      + this.settings.documents_Yuho + ','
      + this.settings.documents_Sokai + ','
      + this.settings.documents_Tekizi + ','
      + this.settings.documents_Other ;

    //初期読み込み対象指定
    this.ary_doc_no = this.settings.documents_all.split(",");

    //記事年範囲取得
    this.setMaxMinYear(this.documents);
  };

  /*========================================================
   年選択ボタン生成
  ========================================================*/
  XjStorageLoaderNews.prototype.setMaxMinYear = function (code) {
    var self = this;
    var xjurl = '';

    //URL生成
    xjurl += self.settings.domain + '/public-list/GetList2.aspx?company=';
    xjurl += self.settings.company;
    xjurl += '&len=10000';

    // タイプ指定
    if (this.documents && this.documents.length > 0) {
      xjurl += '&doctype=' + this.documents;
    }

    xjurl += '&output=json&callback=?';

    $.ajax({
      url: xjurl,
      dataType: 'json',

      success: function (data) {
        if (undefined == data.items) {
          return;
        }

        $.each(data.items, function (i, item) {
          // 目的の文書番号でなかったら
          if (-1 == self.ary_doc_no.indexOf(item.disclosureCode)) {
            return true;
          }

          var date = item.publishDate.split(' ')[0].split('/');
          var entry_year = date[0];

          //最新の年月期と最古の年月期を取得
          if (self.select_latest === '' || self.select_latest < entry_year) {
            self.select_latest = entry_year;
          }

          if (self.select_oldest === '' || self.select_oldest >= entry_year) {
            self.select_oldest = entry_year;
          }
        });
      },
      complete: function () {
        self.setDateButton();
        self.setDocumentButton();
        self.show();
      }
    });
  }

  /*========================================================
   年選択ボタン生成
  ========================================================*/
  XjStorageLoaderNews.prototype.setDateButton = function () {
    var self = this;
    self.active_select = self.select_latest;
    var ul = $('#xj-select-year_s');

    $('#xj-title').html(self.select_latest + '年');


    //年範囲分年メニュー生成
    for (var i = self.select_latest; i >= self.select_oldest; i--) {

      if (i !== '') {
        if (i == self.active_select) {
          var tmp = $('<option value="' + i + '" selected>' + i + '年</option>');
        } else {
          var tmp = $('<option value="' + i + '">' + i + '年</option>');
        }
      } else {
        $("#xj-select-year_s").css('display', 'none');
        $("#xj-title").css('display', 'none')
      }

      ul.append(tmp);
    }

    ul.change(function () {
      var year = $('#xj-select-year_s option:selected').val();

      $('#xj-select-year_s').val(year);

      if ("" == year) {
        self.fdate = "";
        self.pdate = "";
        self.setDuration(year, year);
        self.show();
        //$( '#xj-title').html('最新20件');
        return;
      }
      $('#xj-title').html(year + '年');
      self.setDuration(year, year);
    });
    self.setDuration(self.active_select);
  }

  /*========================================================
   カテゴリー選択ボタン生成
  ========================================================*/
  XjStorageLoaderNews.prototype.setDocumentButton = function () {
    var self = this;

    //カテゴリーボタン生成
    var ul = $( '#irlibrarymenu_out' ) ;

    ul.append(
      $('<a href="javascript:void(0);" class="select"></a>').click(function () {
        self.setDocument(self.settings.documents_all);
      }).append('すべて'));

    ul.append(
      $('<a href="javascript:void(0);"></a>').click(function () {
        self.setDocument(self.settings.documents_Kessan);
      }).append('決算短信'));

    ul.append(
      $('<a href="javascript:void(0);"></a>').click(function () {
        self.setDocument(self.settings.documents_Setsumei);
      }).append('説明資料'));

    ul.append(
      $('<a href="javascript:void(0);"></a>').click(function () {
        self.setDocument(self.settings.documents_Yuho);
      }).append('有報'));

    ul.append(
      $('<a href="javascript:void(0);"></a>').click(function () {
        self.setDocument(self.settings.documents_Sokai);
      }).append('株主総会'));

    ul.append(
      $('<a href="javascript:void(0);"></a>').click(function () {
        self.setDocument(self.settings.documents_Tekizi);
      }).append('適時開示'));

    ul.append(
      $('<a href="javascript:void(0);"></a>').click(function () {
        self.setDocument(self.settings.documents_Other);
      }).append('その他資料'));
   

    //カテゴリー選択ボタンロールオーバー等
    $('#irlibrarymenu_out a').click(function () {
      $('#irlibrarymenu_out a.select').removeClass('select');
      $(this).addClass('select');
    });

  }

  /*========================================================
   絞込み期間更新
  ========================================================*/
  XjStorageLoaderNews.prototype.setDuration = function (f, p) {
    this.fdate = f;
    this.pdate = p;
    this.show();
  }

  /*========================================================
   絞込みカテゴリー更新
  ========================================================*/
  XjStorageLoaderNews.prototype.setDocument = function (d) {
    this.documents = d;
    this.show();
  }

  /*========================================================
   表示処理
  ========================================================*/
  XjStorageLoaderNews.prototype.show = function () {
    var self = this;
    var is_first = true;

    var url = this.settings.domain + '/public-list/GetList2.aspx?company=';

    url += this.settings.company;

    // 日付範囲指定
    /*if (this.fdate && this.fdate.length > 0) {
      url += '&fdate=' + this.fdate;
    }

    if (this.pdate && this.pdate.length > 0) {
      url += '&pdate=' + this.pdate;
    }*/


    // 取得個数指定
    if (!(this.pdate && this.pdate.length > 0)
      && !(this.fdate && this.fdate.length > 0)) {
      url += '&len=' + self.settings.len;
    } else {
      url += '&len=10000';
    }


    // タイプ指定
    if (this.documents && this.documents.length > 0) {
      url += '&doctype=' + this.documents;
    }

    //url+= '&filetype=PDF-GENERAL';
    url += '&output=json&callback=?';

    $.getJSON(url, function (data) {
      $('#xj-mainlist').empty();

      var cont = '';

      if (data.items) {

        var j = 0;
        var now_dd = new Date();

        $.each(data.items, function (i, item) {
          // 目的の文書番号でなかったら
          if (-1 == self.ary_doc_no.indexOf(item.disclosureCode)) {
            return true;
          }

          // 日付設定
          var date = item.publishDate.split(' ')[0].split('/');
          var dateStr = date[0] + '年' + date[1] + '月' + date[2] + '日';
          var date_dd = new Date(parseInt(date[0], 10),
            parseInt(date[1], 10) - 1,
            parseInt(date[2], 10));


          // 年度の算出
          var entry_year = Number(date[0]);

          if (('' == self.fdate || !self.fdate)) {
            if (j < 0) {
              return true;
            }
          } else if (self.fdate != entry_year) {
            return true;
          }

          var entrytype = '';
          var url = '';
          var size = '';
          var page = '';

          if (item.files) {
            $.each(item.files, function (j, file) {
              if (file.type == 'PDF-GENERAL') {
                url = file.url;
                size = parseInt(file.size);
                page = file.page;
              } else if (file.type == 'HTML-GENERAL') {
                url = file.url;

              }
            });
          }

          // サイズ設定
          if (size > 0) {
            if (size > 1000000) {
              size = parseInt(size / 1000000) + 'M';
            } else if (size > 1000) {
              size = parseInt(size / 1000) + 'K';
            }
          } else {
            size = '－';
          }


          // アイコンファイル設定
          var icon_class = '';
          var icon_alt = '';

          if (-1 != self.ary_doc_Kessan.indexOf(item.disclosureCode)) {
            icon_class = 'label-kessan';
            icon_alt = '決算短信';
          } else if (-1 != self.ary_doc_Setsumei.indexOf(item.disclosureCode)) {
            icon_class = 'label-setsumei';
            icon_alt = '説明資料';
          } else if (-1 != self.ary_doc_Yuho.indexOf(item.disclosureCode)) {
            icon_class = 'label-yuho';
            icon_alt = '有報';
          } else if (-1 != self.ary_doc_Sokai.indexOf(item.disclosureCode)) {
            icon_class = 'label-sokai';
            icon_alt = '株主総会';
          } else if (-1 != self.ary_doc_Tekizi.indexOf(item.disclosureCode)) {
            icon_class = 'label-tekizi';
            icon_alt = '適時開示';
          } else if (-1 != self.ary_doc_Other.indexOf(item.disclosureCode)) {
            icon_class = 'label-other';
            icon_alt = 'その他資料';
          } 


          // 画面表示
          cont += '<li class="rss-item">';
          
          if (url != '') {
            cont += '<a href="' + url + '" target="_blank">';
          }else{
            cont += '<span class="no-link">';
          }

          cont += '<p class="category">' + icon_alt + '</p>';

          cont += '<p class="date">' + dateStr + '</p>';

          cont += '<p class="title">';

          cont += item.title;


          /*if (url != '' && size != '－') {
            cont += '<span class="icon icon-pdf">（' + size + 'B）</span>';
          } else if (url != '') {
            cont += '<span class="icon icon-blank"></span>';
          }*/

          cont += '</p>';

          if (url != '') {
            cont += '</a>';
          }
          else{
            cont += '</span>';
          }

          cont += '</li>';

          j++;
        });
      }
      if ('' == cont) {
        cont += '<li class="rss-item no-data">ただいま掲載すべき事項はございません。</li>';

      }

      $('#xj-mainlist').append(cont);
    });
  }

}());


$(function () {
  var xj_storage_loader = new XjStorageLoaderNews();
});
