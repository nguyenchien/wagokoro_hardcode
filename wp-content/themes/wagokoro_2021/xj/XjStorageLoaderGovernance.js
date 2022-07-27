// JavaScript Document

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
  XjStorageLoaderGovernance = function (s) {
    var defaults = {
      domain: '//www.xj-storage.jp',
      company: 'AS71125',
      full: '1',
      icon: '1',
      pdf: '1',
      len: '',
      documents_all: '',
      documents_Info: '32,33,109'

    };

    this.settings = $.extend(defaults, s);
    this.fdate;
    this.pdate;
    this.documents;
    this.ary_doc_no;
    this.ary_doc_Info;


    XjStorageLoaderGovernance.prototype.init.call(this);
  };

  /*========================================================
   初期設定
  ========================================================*/
  XjStorageLoaderGovernance.prototype.init = function () {
    $.ajaxSetup({
      scriptCharset: 'shift-jis'
    });
    this.ary_doc_Info = this.settings.documents_Info.split(",");


    this.settings.documents_all =
      this.settings.documents_Info;


    this.documents = this.settings.documents_all;
    this.ary_doc_no = this.settings.documents_all.split(",");

    this.show();
  };

  /*========================================================
   表示処理
  ========================================================*/
  XjStorageLoaderGovernance.prototype.show = function () {
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
      url += '&len=0';
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
          }else{
            cont += '<span class="no-link">';
          }

          cont += '<p class="category">CG報告書</p>';

          cont += '<p class="date">' + dateStr + '</p>';

          cont += '<p class="title">';

          cont += item.title;


          /*if (url != '' && size != '－') {
            cont += '<span class="icon icon-pdf">（' + size + 'B）</span>';
          } else if (url != '') {
            cont += '<span class="icon icon-blank"></span>';
          }*/


          // 30日以内だったら
          /*if ( 30 * 86400000 >= now_dd.getTime ( ) - date_dd.getTime ( ) )
          {
          	cont += '<span class="new">NEW!</span>' ;
          }*/

          cont += '</p>';

          if (url != '') {
            cont += '</a>';
          }
          else{
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
  var xj_storage_loader = new XjStorageLoaderGovernance();
});
