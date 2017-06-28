$(function(){
  //入力チェック
  $("#submit").on('click', function(){
    if ($("input[name='name']").val() == '') {
      alert('名前を入力してください');
      return false;
    } else if ($("input[name='text']").val() == '')  {
      alert('本文を入力してください');
      return false;
    }else if ($("input[name='password']").val() == '')  {
      alert('削除用パスワードを入力してください');
      return false;
    }else {
      $("#form").submit();
    }
  });

  //load more
  $('#load_more').click(function() {
                $('#load_result').load('more.php');
                $('#load_more').hide();
            });

  //modal
  $("#modal-open").click(function(){
    $("#modal").removeClass("hidden");
    $("#mask").removeClass("hidden");
   });

  $("#modal-close").click(function(){
    $("#modal").addClass("hidden");
    $("#mask").addClass("hidden");
  });
  
  $("#mask").click(function(){
    $("#modal-close").click();
  });
});
