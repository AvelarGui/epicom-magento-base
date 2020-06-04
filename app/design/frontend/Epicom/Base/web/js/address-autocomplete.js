/**
 * Address Auto Fill based on Postcode
 *
 * Author:
 *   Rafael Patro <rafaelpatro@gmail.com>
 *
 * Intallation:
 *   Add a CMS Static Block applying the entire script below.
 *   Add a Widget to pages with address forms.
 *
 * License:
 *   GNU General Public License <http://www.gnu.org/licenses/>.
 *
 * ----------------------------------------------------------------------
 * Autopreenchimento de Endereço utilizando o CEP
 *
 * Autor:
 *   Rafael Patro <rafaelpatro@gmail.com>
 *
 * Requisitos:
 *   Este programa utiliza um webserver de consulta de CEP para
 *   obter os dados de endereço. É possível utilizar qualquer
 *   servidor. Basta alterar a url de requisição em 'this.url'
 *   e o mapeamento dos campos de retorno em 'this.fieldmap'.
 *
 * Instalação:
 *   Inserir o script abaixo via CMS > Blocos Estáticos.
 *   Adicionar o CMS > Widget respectivo nas páginas onde houver
 *   o formulário de endereço (ex.: onepage checkout, customer
 *   account address)
 *
 * Licença:
 *   Licença Pública Geral GNU <http://www.gnu.org/licenses/>.
 *
 */
var Rastro = function(){
  this.region = {
    'AC' : 'Acre',
    'AL' : 'Alagoas',
    'AP' : 'Amapá',
    'AM' : 'Amazonas',
    'BA' : 'Bahia',
    'CE' : 'Ceará',
    'DF' : 'Distrito Federal',
    'ES' : 'Espírito Santo',
    'GO' : 'Goiás',
    'MA' : 'Maranhão',
    'MT' : 'Mato Grosso',
    'MS' : 'Mato Grosso do Sul',
    'MG' : 'Minas Gerais',
    'PA' : 'Pará',
    'PB' : 'Paraíba',
    'PR' : 'Paraná',
    'PE' : 'Pernambuco',
    'PI' : 'Piauí',
    'RJ' : 'Rio de Janeiro',
    'RN' : 'Rio Grande do Norte',
    'RS' : 'Rio Grande do Sul',
    'RO' : 'Rondônia',
    'RR' : 'Roraima',
    'SC' : 'Santa Catarina',
    'SP' : 'São Paulo',
    'SE' : 'Sergipe',
    'TO' : 'Tocantins'
  };

  this.fieldmap = [
    {'logradouro'  : 'input[name*=street][name$=\[\]]:nth(0)'},
    {'complemento' : 'input[name*=street][name$=\[\]]:nth(2)'},
    {'bairro'      : 'input[name*=street][name$=\[\]]:nth(3)'},
    {'localidade'  : 'input[name*=city]'},
    {'uf'          : 'input[name*=region]'},
    {'uf'          : 'select[name*=region_id]'}
  ];
  
  //this.url = 'http://cep.republicavirtual.com.br/web_cep.php?cep=%postcode&formato=json';
  //this.url = 'https://apps.widenet.com.br/busca-cep/api/cep.json?code=%postcode';
  this.url = 'https://viacep.com.br/ws/%postcode/json/';
};

Rastro.prototype = {

  getSelectors : function() {
    return this.fieldmap.map(function(elem){
      for (var i in elem) return elem[i]
    });
  },

  isBadIE : function() {
    if (   $(navigator).appVersion.match(/MSIE 10/g)
      || $(navigator).appVersion.match(/MSIE 9/g)
      || $(navigator).appVersion.match(/MSIE 8/g)
    ){
      return true;
    }
    return false;
  },

  stopProgress : function(elem) {
    elem.up().removeClassName('loader-postcode');
    elem.form.removeClassName('field-disabled');
    return this;
  },

  startProgress : function(elem) {
    elem.form.addClassName('field-disabled');
    elem.up().addClassName('loader-postcode');
    return this;
  },

  /**
   * Method to simplify the cleaning fields process
   */
  clear : function(elem) {
    elem.form.select(this.getSelectors()).each(function(e){
      e.setValue('');
    });
    return this;
  },

  setFieldValue : function(field, value) {
    var optionList, optionFirst;
    if (optionList = field.select('option[textContent=' + this.region[ value ] + ']')) {
      if (optionFirst = optionList.first()) {
        optionFirst.selected = 'selected';
        return this;
      }
    }
    field.setValue(value);
    return this;
  },

  /**
   * Loads the result to the respective fields
   */
  autofill : function(elem, result) {
    var _this = this;
    this.fieldmap.each(function(object){
      for (var key in object) {
        var field = null, fieldFirst = null;
        if (field = elem.form.select( object[key] ))
          if (fieldFirst = field.first())
            _this.setFieldValue(fieldFirst, result[key]);
      }
    });
    return this;
  },

  /**
   * Sends the request and manages the result
   */
  init : function(elem) {
    this.startProgress(elem);
    var _this = this; 
    $j.get(this.url.replace(/%postcode/g, elem.value), {cep:elem.value}, function(response){
      if (response != false) {
        _this.autofill(elem, response);
      } else {
        _this.clear(elem);
      }
      _this.stopProgress(elem);
    }).fail(function(){
      _this.clear(elem);
      _this.stopProgress(elem);
    });
    return this;
  }
};

(function(){
  var css = '\
    .loader-postcode::after {\
      content: url(/skin/frontend/rwd/default/images/opc-ajax-loader.gif);\
    }\
    .field-disabled {\
      opacity: 0.5;\
    }\
  ';
  document.head.insert({bottom: new Element('style', {type:'text/css'}).update(css)});
  $$('input[name*=postcode]').each(function(elem){
    var eventName = (new Rastro()).isBadIE() ? 'blur' : 'change';
    elem.observe(eventName, function(e){
      if (this.value.length == 8) {
        (new Rastro()).init(this);
      }
    });
  });
})();
