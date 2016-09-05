$('#search').on('click', function(){
  
  $.ajax({

    url : '/articles',

    type : 'GET',

    dataType : 'json',

    data : {

      'keywords' : $('#keywords').val()

    },

    success : function(data) {

      $('#articles-list').html(data['view']);

    },

    error : function(xhr, status) {

      console.log(xhr.error + " ERROR STATUS : " + status);

    },

    complete : function() {

      alreadyloading = false;

    }

  });

});
