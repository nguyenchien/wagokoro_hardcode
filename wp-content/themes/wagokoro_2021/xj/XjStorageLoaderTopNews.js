// JavaScript Document

//========================================================
//
// ■XJStorageLoaderクラス定義
//
//========================================================
(function ($) {

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
    XjStorageLoaderIrTop = function (s) {
      var defaults = {
        domain: '//www.xj-storage.jp',
        company: 'AS71125',
        full: '1',
        icon: '1',
        pdf: '1',
        len: '4',
        documents_all: '',
        documents_Kessan: '1,2,3,4,16,17,18,19,20,21',
        documents_Setsumei: '13,98',
        documents_Yuho: '99,105,106,107,108,1030,1040,1080,1090,1100,1120,1130,1135,1136,1140,1150,1160,1170,1180,1190,1200,1210,1220,1230,1235,1236,1240,1250,1260,1270,1280,1290,1300,1310,1320,1350,1360',
        documents_Sokai: '34,91,111,1900',
        documents_Tekizi: '0,5,6,8,9,15,24,25,28',
        documents_Other: '90,92,93,95,96,97,101,102,103,104,110,112,113,114,115,116,117,118,119,120',
        documents_Info: '14,200'

      };

      this.settings = $.extend(defaults, s);
      this.fdate;
      this.pdate;
      this.documents;
      this.ary_doc_no;
      this.ary_doc_Kessan;
      this.ary_doc_Setsumei;
      this.ary_doc_Yuho;
      this.ary_doc_Sokai;
      this.ary_doc_Tekizi;
      this.ary_doc_Other;
      this.ary_doc_Info;


      XjStorageLoaderIrTop.prototype.init.call(this);
    };

    /*========================================================
     初期設定
    ========================================================*/
    XjStorageLoaderIrTop.prototype.init = function () {
      $.ajaxSetup({
        scriptCharset: 'utf-8'
      });

      this.ary_doc_Kessan = this.settings.documents_Kessan.split(",")
      this.ary_doc_Setsumei = this.settings.documents_Setsumei.split(",");
      this.ary_doc_Yuho = this.settings.documents_Yuho.split(",");
      this.ary_doc_Sokai = this.settings.documents_Sokai.split(",");
      this.ary_doc_Tekizi = this.settings.documents_Tekizi.split(",");
      this.ary_doc_Other = this.settings.documents_Other.split(",");
      this.ary_doc_Info = this.settings.documents_Info.split(",");


      this.settings.documents_all =
        this.settings.documents_Kessan + ','
        + this.settings.documents_Setsumei + ','
        + this.settings.documents_Yuho + ','
        + this.settings.documents_Sokai + ','
        + this.settings.documents_Tekizi + ','
        + this.settings.documents_Other + ','
        + this.settings.documents_Info;


      this.documents = this.settings.documents_all;
      this.ary_doc_no = this.settings.documents_all.split(",");

      this.show();
    };

    /*========================================================
     表示処理
    ========================================================*/
    XjStorageLoaderIrTop.prototype.show = function () {
      var url = this.settings.domain + '/public-list/GetList2.aspx?company=';
      var self = this;
      var is_first = true;

      url += this.settings.company;

      if (this.fdate && this.fdate.length > 0) {
        url += '&fdate=' + this.fdate;
      }

      if (this.pdate && this.pdate.length > 0) {
        url += '&pdate=' + this.pdate;
      }

      if (this.documents && this.documents.length > 0) {
        url += '&doctype=' + this.documents;
      }

      if (self.settings.len && self.settings.len > 0) {
        url += '&len=' + self.settings.len;
      } else if (!(this.pdate && this.pdate.length > 0)
        && !(this.fdate && this.fdate.length > 0)) {
        url += '&len=4';
      } else {
        url += '&len=10000';
      }

      url += '&output=json&callback=?';

      //clipboardData.setData('text',url);

      $.getJSON(url,
        function (data) {
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
              } else if (-1 != self.ary_doc_Info.indexOf(item.disclosureCode)) {
                icon_class = 'label-info';
                icon_alt = 'お知らせ';
              }

              // 日付設定
              var date = item.publishDate.split(' ')[0].split('/');
              var dateStr = date[0] + '年' + date[1] + '月' + date[2] + '日';
              var date_dd = new Date(parseInt(date[0], 10),
                parseInt(date[1], 10) - 1,
                parseInt(date[2], 10));


              // 画面表示

              cont += '<li class="rss-item">';

              if (url != '') {
                cont += '<a href="' + url + '" target="_blank">';
              } else {
                cont += '<span class="no-link">';
              }

              cont += '<p class="category">' + icon_alt + '</p>';

              cont += '<p class="date">' + dateStr + '</p>';

              cont += '<p class="title">';

              cont += item.title;

              cont += '</p>';

              if (url != '') {
                cont += '</a>';
              } else {
                cont += '</span>';
              }

              cont += '</li>';
            });
          } else {
            cont += '<li class="rss-item no-data">ただいま掲載すべき事項はございません。</li>';

          }

          $('#xj-mainlist').append(cont);
        });
    }

  }());

  $(function () {
    var xj_storage_loader = new XjStorageLoaderIrTop();
  });
})(jQuery);
