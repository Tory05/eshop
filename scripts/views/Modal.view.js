
import View from "./View.js";

class ModalView extends View{


    constructor() {
        super();
        this.parentNode = $('.modal-body');
    }

    createView($data, $addedProduct) {
        this.parentNode.html('');
        let $message = "";
        if($data['state'] = 'OK'){
            $message = `${$addedProduct} kosárba rakva.`;
        }else{
            $message = `${$addedProduct} jelenleg nem elérhető!`
        }
        this.parentNode.html($message);
    }
}

export default new ModalView();
