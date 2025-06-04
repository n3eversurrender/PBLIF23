  const editors = [
    { toolbar: '#toolbar-deskripsi', editor: '#editor-deskripsi' },
  ];

  editors.forEach(({ toolbar, editor }) => {
    new Quill(editor, {
      theme: 'snow',
      modules: {
        toolbar: toolbar
      },
    });
  });