<div class="wrap">
  
  <div id="icon-options-general" class="icon32"></div>
  <h1>Helper, Developer</h1>

  <h2>Plugin Data</h2>
  <table class="form-table">
    <tr valign="top">
      <th scope="row">Nombre</th>
      <td>SimpleMercado</td>
    </tr>        
    <tr valign="top">
      <th scope="row">Colores</th>
      <td>
          http://www.colorschemedesigner.com/#1Y61TsOsOFfFf
          <div id="csd3-coltable"><h4>Primary Color:</h4><table class="info-table"><tbody><tr><td class="cbox bg-pri-0" style="background-color: rgb(214, 227, 23);"></td><td class="cbox bg-pri-1" style="background-color: rgb(146, 152, 60);"></td><td class="cbox bg-pri-2" style="background-color: rgb(115, 122, 4);"></td><td class="cbox bg-pri-3" style="background-color: rgb(236, 245, 97);"></td><td class="cbox bg-pri-4" style="background-color: rgb(240, 245, 156);"></td></tr><tr><td class="code">D6E317</td><td class="code">92983C</td><td class="code">737A04</td><td class="code">ECF561</td><td class="code">F0F59C</td></tr></tbody></table><h4>Secondary Color A:</h4><table class="info-table"><tbody><tr><td class="cbox bg-sec1-0" style="background-color: rgb(136, 211, 21);"></td><td class="cbox bg-sec1-1" style="background-color: rgb(108, 142, 56);"></td><td class="cbox bg-sec1-2" style="background-color: rgb(70, 114, 4);"></td><td class="cbox bg-sec1-3" style="background-color: rgb(183, 240, 95);"></td><td class="cbox bg-sec1-4" style="background-color: rgb(206, 240, 152);"></td></tr><tr><td class="code">88D315</td><td class="code">6C8E38</td><td class="code">467204</td><td class="code">B7F05F</td><td class="code">CEF098</td></tr></tbody></table><h4>Secondary Color B:</h4><table class="info-table"><tbody><tr><td class="cbox bg-sec2-0" style="background-color: rgb(230, 200, 23);"></td><td class="cbox bg-sec2-1" style="background-color: rgb(154, 140, 61);"></td><td class="cbox bg-sec2-2" style="background-color: rgb(123, 106, 4);"></td><td class="cbox bg-sec2-3" style="background-color: rgb(246, 225, 98);"></td><td class="cbox bg-sec2-4" style="background-color: rgb(246, 233, 156);"></td></tr><tr><td class="code">E6C817</td><td class="code">9A8C3D</td><td class="code">7B6A04</td><td class="code">F6E162</td><td class="code">F6E99C</td></tr></tbody></table><h4>Complementary Color:</h4><table class="info-table"><tbody><tr><td class="cbox bg-compl-0" style="background-color: rgb(118, 21, 152);"></td><td class="cbox bg-compl-1" style="background-color: rgb(86, 43, 102);"></td><td class="cbox bg-compl-2" style="background-color: rgb(61, 4, 82);"></td><td class="cbox bg-compl-3" style="background-color: rgb(187, 93, 220);"></td><td class="cbox bg-compl-4" style="background-color: rgb(200, 143, 220);"></td></tr><tr><td class="code">761598</td><td class="code">562B66</td><td class="code">3D0452</td><td class="code">BB5DDC</td><td class="code">C88FDC</td></tr></tbody></table></div>
      </td>
    </tr>        
  </table>
  <h2>Carrito</h2>
  <h3>Filtros en las Aciones (Filters)</h3>
  <p>
    El carrito tiene 2 actiones puntuales: 
    <ul><li>- add_producto</li><li>- remove_producto</li></ul> 
    Para esto hay 3 filtros con los que podes modificar el funcionamiento y agregar tus propias acciones:
    <ul>
      <li>- simpleMercado_ajax_{$action}_request</li>
      <li>- simpleMercado_ajax_{$action}_controller</li>
      <li>- simpleMercado_ajax_{$action}_response</li>
    </ul>
  </p>

  <table class="widefat">
    <thead><tr><th class="row-title" colspan="3"><h4>simpleMercado_ajax_{$ACTION}_request<h4></th></tr></thead>
    <tbody>
      <tr class="alternate"><td class="row-title">Request Params</td><td></td><td>EJ</td></tr>
      <tr valign="top">
        <td>1: { code: $_GET[_sm_code], action: $_GET['_sm_action'], producto: $post, attr: $_POST['_sm_attr'] }</td>
        <td></td>
        <td>Si quieren cambiar la accion "add_carro" a una personalizada este seria el codigo:
<pre>
function change_action_add_respuesta_json($request) {
  $request['action'] = 'my_add_carrito';
  return $request;
}
add_filter( 'simpleMercado_ajax_add_producto_request', 
            'action_add_respuesta_json', 
            15, 
            3);</pre></a>
        </td>
      </tr>
    </tbody>

    <thead><tr><th class="row-title" colspan="3"></th></tr>
    <tr><th class="row-title" colspan="3"><h4>simpleMercado_ajax_{$ACTION}_controller</h4></th></tr></thead>
    <tbody>
    <tr valign="top">
      <tr class="alternate"><td class="row-title">Request Params</td><td></td><td>EJ</td></tr>
      <td>1: { error: integer, txt: string, exit: 0/1, ( attr: array )<br />2: { code: $_GET[_sm_code], action: $_GET['_sm_action'], producto: $post, attr: $_POST['_sm_attr'] }</td>
      <td>Basicamente aca tendria que, hacerce la accion en si misma. separandolo de la respuesta. por lo general no tendrias que tocar esto.</td>
      <td></td>
    </tr>
    </tbody>
    <thead><tr><th class="row-title" colspan="3"></th></tr>
    <tr><th class="row-title" colspan="3"><h4>simpleMercado_ajax_{$ACTION}_response</h4></th></tr></thead>
    <tbody>
      <tr class="alternate"><td class="row-title">Request Params</td><td></td><td>EJ</td></tr>
      <tr valign="top">
        <td>1: { error: integer, txt: string, exit: 0/1, ( attr: array )<br />2: { code: $_GET[_sm_code], action: $_GET['_sm_action'], producto: $post, attr: $_POST['_sm_attr'] }</td>
        <td>Este fltro envia el contenido que se va a imprimir, un estatus de la acction ( opcionalmente puede enviar un array con atrivutos )</td>
        <td>Si queremos cambiar la respuesta actual del boton "añadir al carrito" a una respuesta en JSON este podria ser el codigo <br />
          <pre>function action_add_respuesta_json($status, $params) {
  echo json_encode( $status );
  $status['exit'] = 1;
  return $status;
}
add_filter( 'simpleMercado_ajax_add_producto_response', 
            'action_add_respuesta_json', 
            15, 
            3);
</pre>
de esta forma usamos el controlador y customisamos la vista
        </td>
      </tr>
    </tbody>
  </table>

  <h3>Otros Filtros del carrito</h3>
  <p></p>

  <table class="widefat">
    <thead><tr><th class="row-title" colspan="3"><h4> -  - <h4></th></tr></thead>
    <tbody>
      <tr class="alternate"><td class="row-title">Request Params</td><td></td><td>EJ</td></tr>
      <tr valign="top">
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>

    <thead><tr><th class="row-title" colspan="3"></th></tr>
    <tr><th class="row-title" colspan="3"><h4> -  - </h4></th></tr></thead>
    <tbody>
      <tr class="alternate"><td class="row-title">Request Params</td><td></td><td>EJ</td></tr>
      <tr valign="top">
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>


<br />
<br />
<br />
<br />




















  <h2>Shortcode</h2>
  <table class="widefat">
    <thead>
      <tr>
        <th class="row-title">Shortcode</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr valign="top">
        <td class="row-title">[smHome]</th>
        <td>segun la configuracion agrega contenido en la home</td>
      </tr>
      <tr valign="top" class="alternate">
        <td class="row-title">[smSlider cat="1"]</th>
        <td>Carrucel de productos</td>
      </tr>
      <tr valign="top">
        <td class="row-title">[smListado cat="1"]</th>
        <td>Listado de productos</td>
      </tr>
      <tr valign="top" class="alternate">
        <td class="row-title">[smAddBtn producto_id="1"]</th>
        <td>
          Boton para añadir al carrito.<br />
        </td>
        <td>
          producto_id: POST ID<br />
          contenido_before: ''<br />
          contenido_after: ''<br />
        </td>
        <td>
          simpleMercado_boton_add_carrito_before<br />
          simpleMercado_boton_add_carrito_after<br />
          simpleMercado_boton_add_carrito_form_prepend<br />
          simpleMercado_boton_add_carrito_form_append<br />
        </td>
      </tr>
      <tr valign="top">
        <td class="row-title">[smGaleria producto_id="1"]</th>
        <td>Galeria del producto</td>
      </tr>
      <tr valign="top" class="alternate">
        <td class="row-title">[smCarrito]</th>
        <td>Pagina de carrito</td>
      </tr>
    </tbody>
  </table>

  <h1>Clases</h1>
  <h2>Configuracion</h2>
  <table class="form-table">
    <tr valign="top">
      <th scope="row">Class smConfig</th>
      <td>
        <table class="widefat">
          <tr>
            <tr>
            <td class="row-title"><label for="tablecell">smConfig::$data</label></td>
            <td></td>
          </tr>
          <tr class="alternate">
            <td class="row-title"><label for="tablecell">smConfig::set($k, $v)</label></td>
            <td>
              <code>smConfig::set($k, $v)      { self::$data[$k] = $v; }</code> 
            </td>
          </tr>
          <tr>
            <tr>
            <td class="row-title"><label for="tablecell">smConfig::get($k, $d=null)</label></td>
            <td>
              
              <code>smConfig::get($k, $d=null) { return ( isset(self::$data[$k]) ? self::$data[$k] : $d ); } </code> 
            </td>
          </tr>
          <tr class="alternate">
            <td class="row-title"><label for="tablecell">smConfig::sets($vs)</label></td>
            <td>
              
              <code>smConfig::sets($vs) { $r=array(); foreach($vs as $k => $d) { self::set($k, $d); } }</code> 
            </td>
          </tr>
          <tr>
            <tr>
            <td class="row-title"><label for="tablecell">smConfig::gets($vs)</label></td>
            <td>
              
              <code>smConfig::gets($vs) { $r=array(); foreach($vs as $k => $d) { $r[$k] = self::get($k, $d); } return $r; }</code> 
            </td>
          </tr>
          <tr class="alternate">
            <tr>
            <td class="row-title"><label for="tablecell">smConfig::init()</label></td>
            <td>
              
              <code>smConfig::init() { 
  self::$data = unserialize( get_option( '_smConfig', serialize( array() ) ) );
} 
</code> 
            </td>
          </tr>
          <tr>
            <td class="row-title"><label for="tablecell">smConfig::save( $d=null )</label></td>
            <td>
              
              <code>smConfig::save( $d=null ) { 
  update_option( '_smConfig', serialize( ( isset($d) ? $d : self::$data ) ), '', 'yes' );
}</code> 
            </td>
          </tr>

        </table>
         
 
 
 

      </td>
    </tr>        
    <tr valign="top">
      <th scope="row">Config actual</th>
      <td><pre><?php var_dump( smConfig::$data ); ?></pre></td>
    </tr>        
  </table>
   
</div> <!-- .wrap -->