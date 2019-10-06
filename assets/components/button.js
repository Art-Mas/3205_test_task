window.app.Button = (() => {

  /**
   *
   * @param {string} selector
   * @constructor
   */
  function Button($el) {
    const $textField = $el.find('.btn__text');

    this.addEvent = (eventName, handler) => {
      $el.on(eventName, handler);
    };

    this.get$btn = () => {
      return $el;
    };

    this.get$textField = () => {
      return $textField;
    }
  }

  return Button;
})();