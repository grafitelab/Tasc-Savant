<div class="my_meta_control">
 
    <label>Prezzo Originale</label>
 
    <p>
        <input type="text" name="_my_meta[price]" value="<?php if(!empty($meta['price'])){ echo $meta['price'];} else {echo "N/A";} ?>"/>
        <span>Inserisci il prezzo di mercato del prodotto con questo formato: € 99.99</span>
    </p>
    
    <label>Prezzo Scontato</label>
 
    <p>
        <input type="text" name="_my_meta[discounted-price]" value="<?php if(!empty($meta['discounted-price'])) { echo $meta['discounted-price']; }?>"/>
        <span>Inserisci il prezzo scontato del prodotto con questo formato: € 99.99</span>
    </p>
    
    <label>Brand</label>
 
    <p>
        <input type="text" name="_my_meta[brand]" value="<?php if(!empty($meta['brand'])) {echo $meta['brand']; } else {echo "N/A";}?>"/>
        <span>Inserisci la marcs</span>
    </p>
 
    <label>Descrizione</label>
 
    <p>
        <textarea name="_my_meta[description]" rows="3"><?php if(!empty($meta['description'])){ echo $meta['description']; } else {echo "N/A";}?></textarea>
        <span>Inserisci una breve descrizione del prodotto</span>
    </p>
 
</div>