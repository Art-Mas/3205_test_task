window.app.VideoView = (() => {
  /**
   *
   * @constructor
   */
  function VideoView(config) {
    this.__config = config;
  }

  VideoView.prototype.draw = function () {};
  return VideoView;
})();

window.app.YoutubeVideoView = (() => {
  /**
   *
   * @constructor
   * @extends app.VideoView
   */
  function YoutubeVideoView(config) {
    app.VideoView.call(this, config);
  }

  function isMobileResolution() {
    return window.screen.availWidth <= 600;
  }

  YoutubeVideoView.prototype = Object.create(app.VideoView);
  YoutubeVideoView.prototype.draw = function () {
    const c = this.__config;
    const html = `
        <div class="video-preview">
          <div class="video-preview__video js_video-preview__video" style="background: url('${c.thumbnail_url}');">
            <div class="video-preview__play"></div>
          </div>
          <div class="video-preview__title">${c.title}</div>
          <a class="video-preview__author" href="${c.author_url}" target="_blank">
            ${c.author_name}
          </a>
        </div>
      `;
    const $content = $(html);
    $content.find('.js_video-preview__video').on('click', function(e) {
      const $iframe = $(c.html);
      $iframe.attr('src', $iframe.attr('src') + '&autoplay=1');
      if (isMobileResolution()) {
        $iframe.attr('width', '100%');
        $iframe.attr('height', '100%');
      }
      $(this).html($iframe);
    });

    return $content;
  };
  return YoutubeVideoView;
})();

window.app.RutubeVideoView = (() => {
  /**
   *
   * @constructor
   * @extends app.VideoView
   */
  function RutubeVideoView(config) {
    app.VideoView.call(this, config);
  }

  RutubeVideoView.prototype = Object.create(app.VideoView);
  RutubeVideoView.prototype.draw = function () {
    return $('<h1>Not implemented</h1>');
  };
  return RutubeVideoView;
})();