(function ($, Drupal) {
  Drupal.AjaxCommands.prototype.example = function (ajax, response, status) {
    alert(response.message);
  }

})(jQuery, Drupal);
