/**
 * Created by Administrator on 2016/5/29.
 */
+function ($) {
    $.fn.myAlert = function(msg){
        var $this = $(this);
        $this.removeClass("hide");
        $this.find("p").text(msg);
        setTimeout(function(){$this.addClass("hide")},3000);
    }

}(jQuery);