
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
