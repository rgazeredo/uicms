(function($){

	/**
     * Realiza consulta ajax para popular um combobox
     * @param  {string} url Url de onde deve ser feito a consulta
     * @param  {int}    id Identificador que será usado na consulta
     * @param  {int}    selected Valor a ser selecionado
     * @return {string} Html com o resultado da consulta
     */
    $.fn.uiPopulateCombobox = function(params){
        //Recupera o seletor
        var selector = this;

        //Realiza consulta ajax com o parametros informados
        $.ajax({
            url: params.url,
            type: 'POST',
            dataType: 'html',
            data: params,
        })
        .done(function(html) {
            if(html)
            {
                //Popula o seletor com o resultado da consulta
                selector.html(html);
            } else {
                console.log("Erro: uiPopulateCombobox");
            }
        })
        .fail(function() {
            console.log("Erro: uiPopulateCombobox");
        });
    };

    /**
     * Abre o formulário via modal para salvar os dados
     * @param  {object} params Objeto com dados do formulário a ser aberto
     */
    $.fn.uiModalSave = function(params){
        //Recupera o seletor
        var modal = this;

        $.magnificPopup.open({
            removalDelay: 500, //delay removal by X to allow out-animation,
            items: {
                src: modal
            },
            // overflowY: 'hidden', // 
            callbacks: {
                beforeOpen: function(e) {
                    this.st.mainClass = 'mfp-slideUp';
                    //Verifica se precisa fazer validação no formulário
                    if(params.validate)
                    {
                        //Executa a validação no formulário
                        //e chama a função responsável por salvar os dados
                        jQuery(params.form).validate({
                            submitHandler: function() {
                                jQuery(params.form).uiSave(
                                    {
                                        url: params.url,
                                        table: params.table,
                                        convert: params.convert,
                                        _token: params._token,
                                        callback: params.callback
                                    }
                                );
                            }
                        });
                    } else {
                        jQuery(params.form).uiSave(
                            {
                                url: params.url,
                                table: params.table,
                                convert: params.convert,
                                _token: params._token,
                                callback: params.callback
                            }
                        );
                    }
                }
            },
            midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
        });
    }

    /**
     * Abre o formulário via modal para remover os dados
     * @param  {object} params Objeto com dados do formulário a ser aberto
     */
    $.fn.uiModalRemove = function(params){
        //Recupera o seletor
        var modal = this;

         $.magnificPopup.open({
            removalDelay: 500, //delay removal by X to allow out-animation,
            items: {
                src: modal
            },
            // overflowY: 'hidden', // 
            callbacks: {
                beforeOpen: function(e) {
                    this.st.mainClass = 'mfp-slideUp';
                    
                    jQuery(params.form).validate({
                        //Chama a função responsável por remover os dados
                        submitHandler: function() {
                            jQuery(params.form).uiRemove(
                            {
                                url: params.url,
                                table: params.table,
                                _token: params._token,
                                callback: params.callback
                            });
                        }
                    });
                }
            },
            midClick: true
        });
    }

    /**
     * Salva os dados do formulário recebido
     * @param  {object} params Objeto com dados do formulário para salvar
     * @return {function} Executa a função de retorno
     */
    $.fn.uiSave = function(params){
        //Recupera o seletor
        var form = this;

        var data = form.serializeArray();
            data.push({name:'table', value:params.table});
            data.push({name:'_token', value:params._token});
            
        if(params.convert)
        	data.push({name:'convert', value:params.convert});
            
        //Realiza consulta ajax com o parametros informados
        $.ajax({
            url: params.url,
            type: 'POST',
            dataType: 'text',
            data: data,
        })
        .done(function(result) {
            if(result)
            {
                var callback = window[params.callback];
                if (typeof callback == 'function') {
                    callback.call(this);
                }
            } else {
                console.log("Erro: uiSave");
            }
        })
        .fail(function() {
            console.log("Erro: uiSave");
        });
    };

    /**
     * Remove os dados do formulário recebido
     * @param  {object} params Objeto com dados do formulário para salvar
     * @return {function} Executa a função de retorno
     */
    $.fn.uiRemove = function(params){
        //Recupera o seletor
        var form = this;

        var data = form.serializeArray();
            data.push({name:'table', value:params.table});
            data.push({name:'_token', value:params._token});

        //Realiza consulta ajax com o parametros informados
        $.ajax({
            url: params.url,
            type: 'POST',
            dataType: 'text',
            data: data,
        })
        .done(function(result) {
            if(result)
            {
                var callback = window[params.callback];
                if (typeof callback == 'function') {
                    callback.call(this);
                }
            } else {
                console.log("Erro: uiRemove");
            }
        })
        .fail(function() {
            console.log("Erro: uiRemove");
        });
    };

    /**
     * Recupera os dados de um registro de acordo com o id informado
     * @param  {object} params Objeto com dados para buscar pelo id informado
     * @return {function} Executa a função de retorno
     */
    $.fn.uiFind = function(params){
        //Realiza consulta ajax com o parametros informados
        $.ajax({
            url: params.url,
            type: 'POST',
            dataType: 'json',
            data: params,
        })
        .done(function(result) {
            if(result)
            {
                var callback = window[params.callback];
                if (typeof callback == 'function') {
                    callback.call(this, result);
                }
            } else {
                console.log("Erro: uiFind");
            }
        })
        .fail(function() {
            console.log("Erro: uiFind");
        });
    };

    /**
     * Cria tabela dinamica com dataTables
     * @param  {object} columns Objeto com as colunas da tabela
     */
    $.fn.uiDataTable = function(columns){
        $(this).dataTable({
            "iDisplayLength": 25,
            "aoColumns": columns
        });
    };

    /**
	 * Limpa uma url
	 * @param  {string} separator Recebe o caracter que deve ser usando como separador
     * @return {string} Retorna a url limpa
	 */
    $.fn.uiCleanUrl = function(separator){

        if(separator == null || separator == "")
            separator = '-';

        var field = this;

        jQuery(field).keyup(function(event) {

            var url = this.value;
                url = url.toLowerCase();
                url = url.replace(/[^-A-Za-z0-9 ]/g,''); //Remove os caracteres especiais
                url = url.replace(/\s{2,}/g,' '); //Remove multiplos espaços
                url = url.replace(/\s/g, separator); //Altera espaço por -

            this.value = url;
        });
    };
})(jQuery);