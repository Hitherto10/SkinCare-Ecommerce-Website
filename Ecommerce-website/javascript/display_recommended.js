//Download recommended products when page loads
window.addEventListener("load", loadProducts);

//Downloads JSON description of products from server
function loadProducts() {
    //Create request object 
    let request = new XMLHttpRequest();

    //Create event handler that specifies what should happen when server responds
    request.onload = () => {
        //Check HTTP status code
        if (request.status === 200) {
            //Add data from server to page
            displayProducts(request.responseText);
        }
        else
            alert("Error communicating with server: " + request.status);
    };

    //Set up request and send it
    request.open("GET", "../php/recommendation.php");
    request.send();
}

//Loads recommended products into page
function displayProducts(jsonProducts) {
    //Convert JSON to array of product objects
    let prodArray = JSON.parse(jsonProducts);
    let htmlStr1 = "<button class='pre-btn'><img src='../assets/arrow.png'></button>";
    htmlStr1 += "<button class='nxt-btn'><img src='../assets/arrow.png'></button>";
    document.getElementById("btn_section").innerHTML = htmlStr1;
    //Create HTML table containing product data
    let htmlStr2 = "<div class='r_product'>";
    for (let i = 0; i < prodArray.length; ++i) {
        htmlStr2 += '<div class="p_card">';
        htmlStr2 += "<img src='" + prodArray[i].image_url + "'class='card-img-top'>";
        htmlStr2 += '<div class="p_card_body">';
        htmlStr2 += "<h5>" + prodArray[i].brand + "</h5>";
        htmlStr2 += "<p>" + prodArray[i].model + "</p>";
        htmlStr2 += "<p>$" + prodArray[i].price + "</p>";
        htmlStr2 += '<button type="submit" onclick=\'addToCart("' + prodArray[i].id + '","' + prodArray[i].image_url + '", "' + prodArray[i].model + '","' + prodArray[i].price + '")\'';
        htmlStr2 += 'class="btn_cart"><ion-icon class="cart_icon" name="cart-outline"></ion-icon></button>';
        htmlStr2 += "</div>";
        htmlStr2 += "</div>";
    }


    htmlStr2 += "</div>";
    document.getElementById("products").innerHTML = htmlStr2;
    //slider to display recommended products
    const productContainers = [...document.querySelectorAll('.r_product')];
    const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
    const preBtn = [...document.querySelectorAll('.pre-btn')];

    productContainers.forEach((item, i) => {
        let containerDimensions = item.getBoundingClientRect();
        let containerWidth = containerDimensions.width;

        nxtBtn[i].addEventListener('click', () => {
            item.scrollLeft += containerWidth;
            
        })

        preBtn[i].addEventListener('click', () => {
            item.scrollLeft -= containerWidth;
        })
    })
}



