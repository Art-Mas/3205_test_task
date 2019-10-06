window.app.Input = (() => {
  const INPUT_HAS_ERROR_CLASS = 'form__field-wrap--error';

  /**
   *
   * @constructor
   */
  function Input($input, $errorField) {
    let hasError = false;

    this.addError = (errorText) => {
      $errorField.text(errorText);
      $input.addClass(INPUT_HAS_ERROR_CLASS);
      hasError = true
    };

    this.removeErrorIfHas = () => {
      if (hasError) {
        $input.removeClass(INPUT_HAS_ERROR_CLASS);
        hasError = false;
      }
    };

  }
  return Input;
})();