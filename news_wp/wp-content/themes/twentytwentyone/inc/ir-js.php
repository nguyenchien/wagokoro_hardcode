<?php
/**
 * Created by PhpStorm.
 * User: PC-06
 * Date: 3/28/2018
 * Time: 1:45 PM
 */
?>

<?php
if(is_home()){?>
    <script src="<?php echo get_stylesheet_directory_uri() ?>/js/countUp.js" defer="defer" charset="UTF-8"></script>
    <script>
        $(function(){
            var countElm = $('.count'),
                countSpeed = 2.5;
            var options = {
                useEasing: true,
                useGrouping: true,
                separator: ',',
                decimal: '.',
            };
            countElm.each(function(){
                var self = $(this),
                    countMax = self.attr('data-num');
                var id_num = self.attr('id');
                // setup CountUp object - last 3 params (decimals, duration, options) are optional
                var num_count = new CountUp(id_num, 0, countMax, 0, countSpeed, options);
                if (!num_count.error) {
                    num_count.start();
                } else {
                    console.error(num_count.error);
                }
            });
        });
    </script>
    <?php
}
if(get_page_template_slug() == 'page-ir.php'){?>
    <script src="<?php echo get_stylesheet_directory_uri() ?>/js/build/jquery.tab.js" defer="defer" charset="UTF-8"></script>
    <script src="<?php echo get_stylesheet_directory_uri() ?>/js/build/disclosure.js?date=20190419" charset="UTF-8"></script>
<?php
}
if (is_page('ir')) { ?>
    <script type="text/javascript">
        $(document).ready(function () {
            let YEAR_STR = pramWrite();
            // 適時開示
            //print_whatsNew(1, 5, 1, 5, 0, '1,2,3,4,5,6,7,8','', 0);
            print_whatsNew_all(1, 5, 1, 5, 0, '1,2,3,4,5,6,7,8,9','IRCALENDAR,代表メッセージ', 0);
            // library
            print_whatsNewDesign2021('script_out_2021_library', 1, 1000, 1, 5, 0, '1', '1,2', YEAR_STR);
            //  governance
            print_whatsNewDesign2021('script_out_2021_governance', 1, 1000, 1, 5, 0, '1,9', '9,コーポレートG', 0);
            // public
            print_whatsNewDesign2021('script_out_2021_public', 1, 1000, 1, 5, 0, 9, '電子公告', 0);
        });
    </script>
    <?php
}
if (is_page('message')) {
    ?>
    <script type="text/javascript">
        let YEAR_STR = '';
        $(document).ready(function () {
            YEAR_STR = pramWrite();
            print_message(1, 5, 1, 5, 0, '代表メッセージ', YEAR_STR);
        });
    </script>
    <?php
}
if(is_page('governance')){
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            let YEAR_STR = pramWrite();
            print_whatsNew(1, 1000, 1, 5, 0, '1,9', '9,コーポレートG', 0);
        });
    </script>
<?php
}
if (is_page('irnews')): ?>
    <script type="text/javascript">
        $(document).ready(function () {
            print_irnewsMenu();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            let YEAR_STR = pramWrite();
            switch (type_value) {
                case '0':				// すべて
                    //print_whatsNew(1, 1000, 1, 5, 0, '1,2,3,4,5,6,7,8,9', '1,2', YEAR_STR);
                    //print_whatsNew(1, 1000, 1, 5, 0, '1,2,3,4,5,6,7,8','', YEAR_STR);
                    print_whatsNew_all(1, 1000, 1, 5, 0, '1,2,3,4,5,6,7,8,9','IRCALENDAR,代表メッセージ', YEAR_STR);
                    break;
                case '1':				// 決算短信
                    print_timelydisclosure_category(1, 1000, 1, 5, 'published_at_desc', '2,3', YEAR_STR);
                    break;
                case '2':				// 説明資料
                    print_whatsNew(1, 1000, 1, 5, 0, 9, '説明会資料', YEAR_STR);
                    break;
                case '3':				// 有報
                    print_securitiesReport(1, 1000, 1, 5, 'published_at_desc', 0, YEAR_STR);
                    break;
                case '4':				// 株主総会
                    print_whatsNew(1, 1000, 1, 5, 0, 9, '株主総会', YEAR_STR);
                    break;
                case '5':				// 適時開示
					print_timelydisclosure_category(1, 1000, 1, 5, 'published_at_desc', '1,4,5,6,7,8', YEAR_STR);
                    break;
                case '6':				// その他資料
                    print_whatsNew(1, 1000, 1, 5, 0, 9, 'その他資料', YEAR_STR);
                    break;
                default:				// すべて
                    //print_whatsNew(1, 1000, 1, 5, 0, '1,2,3,4,5,6,7,8,9', '1,2', YEAR_STR);
                    //print_whatsNew(1, 1000, 1, 5, 0, '1,2,3,4,5,6,7,8','', YEAR_STR);
                    print_whatsNew_all(1, 1000, 1, 5, 0, '1,2,3,4,5,6,7,8,9','IRCALENDAR,代表メッセージ', YEAR_STR);
                    break;
            }
        });
    </script>

<?php endif; ?> <?php
if (is_page('highlight')): ?>
    <script src="<?php echo get_stylesheet_directory_uri() ?>/js/build/Chart.min.js" charset="UTF-8"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            get_salesAmount_year(1);
            get_operatingIncome_year(2);
            get_ordinaryIncome_year(3);
            get_currentNetIncome_year(4);
            get_currentNetIncomePerStock_year(5);
            get_roe_year(7);
            get_totalAssets_year(10);
            get_netAssets_year(11);
            get_capitalRatio_year(12);
            get_totalAssetsPerStock_year(13);
        });
    </script>
    <?php
endif;
?>
<?php if(is_page('irlibrary')):?>
    <script type="text/javascript">
        $(document).ready(function () {
            print_irlibraryMenu();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            let YEAR_STR = pramWrite();
            switch (type_value) {
                case '0':				// すべて
                    //print_whatsNew(1, 1000, 1, 5, 0, '1,2,3,4,5,6,7,8,9', '1,2', YEAR_STR);
                    print_whatsNew(1, 1000, 1, 5, 0, '1', '1,2', YEAR_STR);
                    break;
                case '1':				// 決算短信
                    print_timelydisclosure_category(1, 1000, 1, 5, 'published_at_desc', '2,3', YEAR_STR);
                    break;
                case '2':				// 説明資料
                    print_whatsNew(1, 1000, 1, 5, 0, 9, '説明会資料', YEAR_STR);
                    break;
                case '3':				// 有報
                    print_securitiesReport(1, 1000, 1, 5, 'published_at_desc', 0, YEAR_STR);
                    break;
                case '4':				// 株主総会
                    print_whatsNew(1, 1000, 1, 5, 0, 9, '株主総会', YEAR_STR);
                    break;
                case '5':				// 適時開示
					print_timelydisclosure_category(1, 1000, 1, 5, 'published_at_desc', '1,4,5,6,7,8', YEAR_STR);
                    break;
                case '6':				// その他資料
                    print_whatsNew(1, 1000, 1, 5, 0, 9, 'その他資料', YEAR_STR);
                    break;
                default:				// すべて
                    //print_whatsNew(1, 1000, 1, 5, 0, '1,2,3,4,5,6,7,8,9', '1,2', YEAR_STR);
                    print_whatsNew(1, 1000, 1, 5, 0, '1', '1,2', YEAR_STR);
                    break;
            }
        });
    </script>
<?php endif; ?>

<?php if(is_page('ircalendar')):?>
    <script type="text/javascript">
        let YEAR_STR = '';
        $(document).ready(function () {
            YEAR_STR = pramWrite();
            print_ircalender(1, 5, 1, 5, 0, 'IRCALENDAR', YEAR_STR);
        });
        $(window).load(function () {
            view_ircalender();
        });
    </script>
<?php endif; ?>

<?php if(is_page('epn')):?>
    <script type="text/javascript">
        let YEAR_STR = '';
        $(document).ready(function(){
            YEAR_STR = pramWrite();
            print_whatsNew(1, 1000, 1, 5, 0, 9, '電子公告', 0);
        });
    </script>
<?php endif; ?>
