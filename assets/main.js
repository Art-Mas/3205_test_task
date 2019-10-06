/** define namespace */
window.app = {};

$(function () {
  const CLASS_VIDEO_INFO_LOADING = 'video-info--loading';
  const CLASS_CONTENT_VIDEO_SHOWN = 'content--video-shown';

  const w = window;
  const app = w.app;

  const $videoUrlInput = $('.js_video-url');
  const $videoInfo = $('.js_video-info');
  const $content = $('.content');
  const $videoInfoContainer = $('.js_video-info__container');

  /** @type Button  */
  const btnGetVideoData = new app.Button($('.js_btn-get-data'));
  const btnState = new app.ButtonState(btnGetVideoData);
  const videoUrlInputValidator = new app.InputValidator($videoUrlInput).notEmpty().correctUrl();
  const videoUrlInput = new app.Input($('.js_video-url-wrap'), $('.js_video-url-errors'));

  /**
   *
   * @param {string} provierType
   * @return {VideoView}
   */
  function getVideoView(provierType, config) {
    switch (provierType) {
      case 'youtube':
        return new app.YoutubeVideoView(config);
      case 'rutube':
        return new app.RutubeVideoView(config);
    }
  }

  function handleVideoInfoResponse(response) {
    btnState.reset();
    $videoInfo.removeClass(CLASS_VIDEO_INFO_LOADING);
    if (response.errors && response.errors.length) {
      videoUrlInput.addError(response.errors.shift())
    } else {
      $content.addClass(CLASS_CONTENT_VIDEO_SHOWN);
      $videoInfoContainer.html(getVideoView(response.provider, response).draw())
    }
  }

  btnGetVideoData.get$btn().on('click', (event) => {
    event.preventDefault();
    event.stopPropagation();
    const errors = videoUrlInputValidator.check();
    if (errors.length) {
      videoUrlInput.addError(errors.shift());
    } else {
      $content.removeClass(CLASS_CONTENT_VIDEO_SHOWN);
      btnState.setLoading().setText('Moment...');
      $videoInfo.addClass(CLASS_VIDEO_INFO_LOADING);
      $.get('api/parse', {v: encodeURI($videoUrlInput.val())})
        .then(r => {
          // API quickly fulfills, the loader twitches. A little enjoy the beauty of the loading :)
          setTimeout(() => {handleVideoInfoResponse(r)}, 1000)
        })
    }
  });

  $videoUrlInput.on('input', () => {
    videoUrlInput.removeErrorIfHas();
  });

  particlesJS.load('js_particles', 'assets/particlesjs-config.json', function() {
  });
});