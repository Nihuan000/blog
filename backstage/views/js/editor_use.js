(function() {
  $(function() {
    var editor, mobileToolbar, toolbar;
    toolbar = ['title', 'bold', 'italic', 'underline', 'strikethrough', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', '|', 'source'];
    mobileToolbar = ["bold", "underline", "strikethrough", "color", "ul", "ol"];
    if (mobilecheck()) {
      toolbar = mobileToolbar;
    }
    return editor = new Simditor({
      textarea: $('#txt-content'),
      placeholder: '这里输入文字...',
      toolbar: toolbar,
      pasteImage: true,
      defaultImage: '/backstage/views/images/image.png',
      upload:{
        url: '/backstage/main/area_img',
        fileKey: 'imgFile',
      }
    });
  });

}).call(this);
