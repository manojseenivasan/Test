/**
 * @category    Ewall
 * @package     Ewall_FilterHelp
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
;(function($) {
    $(function () {
        $('.m-help .m-text').hide();
        $('.m-help')
            .live('mouseover', function () {
                $(this).find('.m-text').show();
            })
            .live('mouseout', function () {
                $(this).find('.m-text').hide();
            });
    });
    $(document).bind('m-ajax-after', function (e, selectors) {
        $('.m-help .m-text').hide();
    });

})(jQuery);