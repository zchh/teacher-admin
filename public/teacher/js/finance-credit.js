function goPage(url, param)
{
    var page = document.getElementById('page_num').value;
    location.href = url+"?page="+page+"&param="+param;
}