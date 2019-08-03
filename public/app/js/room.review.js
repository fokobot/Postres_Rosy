$(function () {
  $(".my-rating").starRating({
      starSize: 25,
      disableAfterRate: false,
      callback: function(currentRating, $el){
          // make a server call here
      }
  });

  $("#btnEnviar").on('click',function () {

    var headers = new Headers();
    headers.set('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));

    var rating = $(".my-rating").starRating('getRating');
    var formData = new FormData();
    formData.append('room_id', $("#room_id").val());
    formData.append('texto', $("#texto").val());
    formData.append('rating', rating);

    var config = { method: 'POST',
                  headers: headers,
                  cache: 'default',
                  body: formData};

    var sendReview = new Request(document.location.origin + '/rooms/review', config);
    fetch(sendReview)
    .then(function (response) {
      if(response.status == 200)
      {
        $("#modal_review").modal('hide');
        return response.json();
      }
    }).then(function (review) {
      var t = "<p>"+review.texto+"</p><small class='text-muted'>Publicada por "+review.user.nombres +" el día "+review.created_at+"</small>"
      $("#reviews").append(t);
    });
  });
});
