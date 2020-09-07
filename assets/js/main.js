function sendNotify(success, message) {
  if (success) {
    $.notify({
      message: '<i class="fas fa-check"></i> ' + message
    }, {
      type: 'success',
      mouse_over: 'pause',
      offset: {
        x: 20,
        y: 70
      }
    });
  } else {
    $.notify({
      message: '<i class="fas fa-exclamation-circle"></i> ' + message
    }, {
    type: 'danger',
    mouse_over: 'pause',
    offset: {
      x: 20,
      y: 70
    }
    });
  }
}
