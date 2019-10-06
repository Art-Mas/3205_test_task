window.app.ButtonState = (() => {
  const LOADING_STATE_CLASS = 'btn--disabled btn--spin';

  /**
   *
   * @param {Button} btn
   * @constructor
   */
  function ButtonState(btn) {
    const $btn = btn.get$btn();
    const $textField = btn.get$textField();
    let btnTextBeforeLoading = '';

    /**
     * @returns {ButtonState}
     */
    this.setLoading = () => {
      $btn.addClass(LOADING_STATE_CLASS);
      return this;
    };

    this.setText = (text) => {
      btnTextBeforeLoading = $textField.text();
      $textField.text(text);
      return this;
    };

    this.reset = (isResetText = true) => {
      $btn.removeClass(LOADING_STATE_CLASS);
      if (isResetText) {
        $textField.text(btnTextBeforeLoading);
        btnTextBeforeLoading = '';
      }
    }
  }

  return ButtonState;
})();