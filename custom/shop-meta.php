<div class="my_meta_control">
     
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras orci lorem, bibendum in pharetra ac, luctus ut mauris. Phasellus dapibus elit et justo malesuada eget <code>functions.php</code>.</p>
 
    <label>Prezzo Originale</label>
 
    <p>
        <input type="text" name="_my_meta[price]" value="<?php if(!empty($meta['price'])) echo $meta['price']; ?>"/>
        <span>Inserisci il prezzo di mercato del prodotto con questo formato: € 99.99</span>
    </p>
    
    <label>Prezzo Scontato</label>
 
    <p>
        <input type="text" name="_my_meta[discounted-price]" value="<?php if(!empty($meta['discounted-price'])) echo $meta['discounted-price']; ?>"/>
        <span>Inserisci il prezzo scontato del prodotto con questo formato: € 99.99</span>
    </p>
 
    <label>Descrizione</label>
 
    <p>
        <textarea name="_my_meta[description]" rows="3"><?php if(!empty($meta['description'])) echo $meta['description']; ?></textarea>
        <span>Inserisci una breve descrizione del prodotto</span>
    </p>
 
</div>