//creating slug
//usage: slug(string);
var slug = function(str) {
    var $slug = '';
    var trimmed = jQuery.trim(str);
    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
        replace(/-+/g, '-').
        replace(/^-|-$/g, '');
    return $slug.toLowerCase();
}

jQuery(document).ready(function () {
    var controller = CONTROLLER.singularize();
    jQuery('#'+controller+'Slug').attr('readonly',true);
    jQuery('#'+controller+'Name').keyup(function(){
        jQuery('#'+controller+'Slug').val(slug(jQuery('#'+controller+'Name').val()));
    });
});