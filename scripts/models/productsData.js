import productTypesView from '../views/ProductTypes.view.js';
import productsView from '../views/Products.view.js';
import modalView from '../views/Modal.view.js';
import cartView from '../views/Cart.view.js';



class ProductsData{

    constructor(){

    }

    renderProductTypesView(url="http://localhost:8080/api/index.php?action=listtypes"){

        $.ajax({
            url:url,
            method: "GET",
        }).done(function(data){
            console.log(data);
            productTypesView.createView(data);
        }).fail(function(error, text){
            console.log(error, text);
        });
    }

    renderProductsView(url){
        $.ajax({
            url: url,
            method: "GET"
        }).done(function(data){
            console.log(data);
            productsView.createView(data);
        }).fail(function(error, text){
            console.log(error, text);
        });

    }


    addToCartAndRenderModal($selectedID, $addedProduct) {
        let self = this;
        let url = "http://localhost:8080/api/index.php?action=addArticle&articleId="+$selectedID;
        $.ajax({
            url: url,
            method: "GET"
        }).done(function(data){
            console.log(data);
            modalView.createView(data, $addedProduct);
        }).fail(function(error, text){
            console.log(error, text);
        });

    }


    renderCartView() {

        let url = "http://localhost:8080/api/index.php?action=listCart"
        $.ajax({
            url: url,
            method: "GET",
        }).done(function(data){
            console.log(data);
            cartView.createView(data);
        }).fail(function(error, text){
            console.log(error, text);
        });
    }


    addItemToCart($itemID) {
        let self = this;
        $.ajax({
            url: `http://localhost:8080/api/index.php?action=addArticle&articleId=${$itemID}`,
            method: "GET"
        }).fail(function(error, text){
            console.log(error, text);
        });
    }

    removeItemFromCart($itemID) {
        let self = this;
        $.ajax({
            url: `http://localhost:8080/api/index.php?action=removeArticle&articleId=${$itemID}`,
            method: "GET"
        }).fail(function(error, text){
            console.log(error, text);
        });
    }
}

export default new ProductsData();


