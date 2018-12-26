function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

async function updateOrderList() {

	while (true) {
    
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    
    xmlhttp.open("GET","chef_page.php",true);
    xmlhttp.send();

    await sleep(10000);

	}
    
}

/*
function takeOrder() {

	if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.open("POST","chef_confirm_order.php",true);
    xmlhttp.send();

}
*/