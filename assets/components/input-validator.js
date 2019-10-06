/**
 *
 * @type {InputValidator}
 */
window.app.InputValidator = (() => {

  const REGEX_CORRECT_URL = 'https?:\\/\\/(www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b([-a-zA-Z0-9()@:%_\\+.~#?&//=]*)';

  /**
   * @constructor
   */
  function InputValidator($input) {
    const validators = [];

    /**
     *
     * @returns {InputValidator}
     */
    this.notEmpty = () => {
      validators.push(($input) => {
        if (!$input.val()) {
          return 'Enter video link';
        }
      });
      return this;
    };

    /**
     *
     * @returns {InputValidator}
     */
    this.correctUrl = () => {
      validators.push(($input) => {
        const regex = new RegExp(REGEX_CORRECT_URL);
        if (!$input.val().match(regex)) {
          return 'Link to video is incorrect'
        }
      });
      return this;
    };

    this.check = () => {
      const errors = [];
      validators.forEach(validate => {
        const error = validate($input);
        if (error) {
          errors.push(error);
        }
      });
      return errors;
    }
  }

  return InputValidator;
})();