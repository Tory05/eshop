import productsData from "./models/productsData.js";

class GUIcontroller{

    constructor(){
    }

    initGUI(){

        $('body').on('click', '.shopping-view-link', (e)=>{
            productsData.renderProductTypesView();
            $('.shoppingView-container').removeClass('d-none');
            $('.welcome').addClass('d-none');
            $('.cart-view-container').addClass('d-none');
        });

        $('body').on('click', '.cart-view-link', (e)=>{
            productsData.renderCartView();
            $('.welcome').addClass('d-none');
            $('.cart-view-container').removeClass('d-none');
            $('.shoppingView-container').addClass('d-none');
        });


        //productsView renderelés kezelő
        $('body').on('click', '.productCategory', (e)=>{
            e.preventDefault();

            $('.productsViewContainer').removeClass('d-none');
            $('a').removeClass('active');
            $(e.currentTarget).addClass('active');
            let selectedUrl = $(e.currentTarget).attr('href');
            productsData.renderProductsView(selectedUrl);

            return false;

        });

         //kosár + modal renderelés kezelő
         $('body').on('click', '.add-to-cart', (e)=>{
             $(".modal-body").html("");
             let $selectedID = $(e.currentTarget).attr('id');
             let $addedProduct = document.getElementsByClassName($selectedID)[0].innerText;
             productsData.addToCartAndRenderModal($selectedID, $addedProduct);
             $("#cartModal").modal('show');
             console.log($selectedID);
             e.preventDefault();
         });

        //kosárba renderelés kezelő
         $('body').on('click', '.increase-qty', (e)=>{
             let $productIdToAdd = $(e.currentTarget).parent().attr('id');
             productsData.addItemToCart($productIdToAdd);
             productsData.renderCartView();
             e.preventDefault();
         });

        //kosárból törlés renderelés kezelő
        $('body').on('click', '.decrease-qty', (e)=>{
            let $productIdToRemove = $(e.currentTarget).parent().attr('id');
            productsData.removeItemFromCart($productIdToRemove);
            productsData.renderCartView();
            e.preventDefault();
        });

    }
}

export default new GUIcontroller();