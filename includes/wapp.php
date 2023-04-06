<!-- Seccion Seguidor -->
<section id="seguidor" class="text-center animated fadeInRight">
  <button id="cerrar-seguidor" style="color: #000000;">
  	<img class="transition" width="20" height="20" src="./../img/close.png" alt="close">
  </button>
  
  <hr style="margin: 10px 0;">

  <div class="click-to-call-mobile">
    <img src="./../img/whatsapp.png" alt="whatsapp">
  </div>

  <h6><strong>¡CONSULTÁ POR WHATSAPP!</strong></h6>
  <a 
    id="whatsapp_desktop" 
    href="<?= $whatsapp[2] ?>" 
    onclick="setNextWhatsapp(rubro)" 
    target="_blank" 
    rel="noopener"
    class="btn btn-wap">CHAT
	</a>
</section>

<section id="seguidor-tel" class="text-center">

	<div class="tex-right">
    <button id="cerrar-seguidor-tel" style="color: #000000;">
      <img width="20" height="20" src="./../img/close.png" alt="close">
    </button>
	</div>

  <a 
    id="whatsapp_mobile" 
    class="transition" 
    href="<?= $whatsapp[2] ?>" 
    onclick="setNextWhatsapp(rubro)" 
    target="_blank" 
    rel="noopener">
      <h5>¡CONSULTÁ POR <br> WHATSAPP!</h5>
	</a>

</section>
<!-- Fin Seccion Seguidor -->