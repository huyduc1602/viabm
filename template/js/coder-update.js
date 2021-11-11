function showAlertBuy() {
    var arr = [
        '****n vừa mua 1 tài khoản Clone veri phone',
        '****h vừa mua 1 tài khoản GMAIL RANDOM TÊN TIẾNG ANH +AVATAR+POP3+IMAP+LIVE77H\n',
        '****k vừa mua 5 tài khoản Clone veri phone',
        '****t vừa mua 3 tài khoản Clone very phone',
        '****n vừa mua 1 tài khoản Clone veri phone 1',
        '****h vừa mua 1 tài khoản GMAIL RANDOM TÊN TIẾNG ANH +AVATAR+POP3+IMAP+LIVE77H\n',
        '****k vừa mua 5 tài khoản Clone veri phone',
        '****t vừa mua 3 tài khoản Clone very phone',
    ];
    var index = 0;
    setInterval(function(){
        toastr.success(arr[index++ % arr.length])
    }, 10000);
}
showAlertBuy();