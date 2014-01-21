<form class="comment-form">
  <div class="row table_productos">
    <h2>Tu pedido</h2>
    <table>
      <thead>
          <tr><th>Producto</th><th>Cantidad</th><th>Precio / unidad</th><th>Total</th><th></th></tr>
      </thead>
      <tbody>
        <tr><td>producto 1</td><td><input type="number" value="0" /></td><td>$ 1 </td><td>$ 5 </td><td><a href="#">Eliminar</a></td></tr>
        <tr><td>producto 1</td><td><input type="number" value="0" /></td><td>$ 1 </td><td>$ 5 </td><td><a href="#">Eliminar</a></td></tr>
        <tr><td>producto 1</td><td><input type="number" value="0" /></td><td>$ 1 </td><td>$ 5 </td><td><a href="#">Eliminar</a></td></tr>
        <tr><td>producto 1</td><td><input type="number" value="0" /></td><td>$ 1 </td><td>$ 5 </td><td><a href="#">Eliminar</a></td></tr>
        <tr><td>producto 1</td><td><input type="number" value="0" /></td><td>$ 1 </td><td>$ 5 </td><td><a href="#">Eliminar</a></td></tr>
      </tbody>
    </table>
  </div>
  <div class="row table_total">
    <table>
      <tbody>
        <tr><th>Total:</th><td>$ 5 </td></tr>
      </tbody>
    </table>
  </div>

  <h2>Tus datos</h2>
  <div class="row">
    <label>Nombre:</label>
    <input type="text" placeholder="Tu nombre" /><br />
  </div>
  <div class="row">
    <label>Apellido:</label>
    <input type="text" placeholder="Tu Apellido" /><br />
  </div>
  <div class="row">
    <label>Email:</label>
    <input type="email" placeholder="Tu Email" />
  </div>
  <div class="row">
    <label>Aclaracion:</label>
    <textarea placeholder="Aclaraciones"></textarea>
  </div>

  <?php if( smConfig::get('mode') == 'carrito' ): ?>
    <h2>Medio de pago</h2>
    <div class="row">
    </div>
  <?php else: ?>
    <div class="row submit">
      <input type="submit" value="Pedir" />
    </div>
  <?php endif; ?>
</form>