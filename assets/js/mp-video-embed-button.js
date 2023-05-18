(function () {
  tinymce.create("tinymce.plugins.MPVideoEmbed", {
    init: function (ed, url) {
      ed.addButton("mp_video", {
        title: "YouTube",
        image: url + "/../../assets/images/youtube.png",
        onclick: function () {
          ed.selection.setContent(
            "[mp_video]" + ed.selection.getContent() + "[/mp_video]"
          );
        },
      });
    },
    createControl: function (n, cm) {
      return null;
    },
  });
  tinymce.PluginManager.add(
    "mp_video_embed_button_script",
    tinymce.plugins.MPVideoEmbed
  );
})();
