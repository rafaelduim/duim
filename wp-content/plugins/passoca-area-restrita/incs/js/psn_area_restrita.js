jQuery(document).ready(function( $ ) {
    $(document).on('submit', '[data-form="psn-restricted-area"]', function(event) {
        event.preventDefault();
        _obj = $(this);
        _data = _obj.serialize();
        _objBtn = _obj.find('input[type="submit"]');
        _objBtn.addClass('disabled');
        _objBtn.attr('disabled','disabled');
    
    
        $.ajax({
            url: ajaxForm.ajax_url,
            type: 'POST',
            dataType: 'JSON',
            data: _data,
            beforeSend: function() {
                console.log('Efetuando login');
            },
            success: function(data, stats) {
                // resposta
                $_resposta = data;
                // verifica se existe
                if ($_resposta) {
                    var _cod, _message;
                    // quebrando os resultados
                    // obtendo o cod
                    // _cod = $_resposta.cod;
                    // _message = $_resposta.message;
    
                    console.log($_resposta);
    
                    // $('[data-form="psn-restricted-area"]')[0].reset();
                    _objBtn.removeClass('disabled');
                    _objBtn.removeAttr('disabled');
    
                } else {
                    alert('Não foi possível realizar o login entre em contato com a equipe de suporte!');
                }
    
            },
            error: function(error) {
                alert('Error!');
                _objBtn.removeClass('disabled');
                _objBtn.removeAttr('disabled');
            }
        })
    });    

    $(document).on('submit', '[data-form="psn-restricted-area-esqueceu-senha"]', function(event) {
        event.preventDefault();
        _obj = $(this);
        _data = _obj.serialize();
        _objBtn = _obj.find('input[type="submit"]');
        _objBtn.addClass('disabled');
        _objBtn.attr('disabled','disabled');
    
    
        $.ajax({
            url: ajaxForm.ajax_url,
            type: 'POST',
            dataType: 'JSON',
            data: _data,
            beforeSend: function() {
                console.log('Efetuando login');
            },
            success: function(data, stats) {
                // resposta
                $_resposta = data;
                // verifica se existe
                if ($_resposta) {
                    var _cod, _message;
                    // quebrando os resultados
                    // obtendo o cod
                    // _cod = $_resposta.cod;
                    // _message = $_resposta.message;
    
                    console.log($_resposta);
    
                    // $('[data-form="psn-restricted-area"]')[0].reset();
                    _objBtn.removeClass('disabled');
                    _objBtn.removeAttr('disabled');
    
                } else {
                    alert('Não foi possível realizar a ação entre em contato com a equipe de suporte!');
                }
    
            },
            error: function(error) {
                alert('Error!');
                _objBtn.removeClass('disabled');
                _objBtn.removeAttr('disabled');
            }
        })
    });   
    
    $(document).on('submit', '[data-form="psn-restricted-area-esqueceu-senha-nova"]', function(event) {
        event.preventDefault();
        _obj = $(this);
        _data = _obj.serialize();
        _objBtn = _obj.find('input[type="submit"]');
        _objBtn.addClass('disabled');
        _objBtn.attr('disabled','disabled');
    
    
        $.ajax({
            url: ajaxForm.ajax_url,
            type: 'POST',
            dataType: 'JSON',
            data: _data,
            beforeSend: function() {
                console.log('Efetuando login');
            },
            success: function(data, stats) {
                // resposta
                $_resposta = data;
                // verifica se existe
                if ($_resposta) {
                    var _cod, _message;
                    // quebrando os resultados
                    // obtendo o cod
                    // _cod = $_resposta.cod;
                    // _message = $_resposta.message;
    
                    console.log($_resposta);
    
                    // $('[data-form="psn-restricted-area"]')[0].reset();
                    _objBtn.removeClass('disabled');
                    _objBtn.removeAttr('disabled');
    
                } else {
                    alert('Não foi possível realizar a ação entre em contato com a equipe de suporte!');
                }
    
            },
            error: function(error) {
                alert('Error!');
                _objBtn.removeClass('disabled');
                _objBtn.removeAttr('disabled');
            }
        })
    });   

    $(document).on('submit', '[data-form="psn-restricted-area-cadastro"]', function(event) {
        event.preventDefault();
        _obj = $(this);
        _data = _obj.serialize();
        _objBtn = _obj.find('input[type="submit"]');
        _objBtn.addClass('disabled');
        _objBtn.attr('disabled','disabled');
    
    
        $.ajax({
            url: ajaxForm.ajax_url,
            type: 'POST',
            dataType: 'JSON',
            data: _data,
            beforeSend: function() {
                console.log('Efetuando login');
            },
            success: function(data, stats) {
                // resposta
                $_resposta = data;
                // verifica se existe
                if ($_resposta) {
                    var _cod, _message;
                    // quebrando os resultados
                    // obtendo o cod
                    // _cod = $_resposta.cod;
                    // _message = $_resposta.message;
    
                    console.log($_resposta);
    
                    // $('[data-form="psn-restricted-area"]')[0].reset();
                    _objBtn.removeClass('disabled');
                    _objBtn.removeAttr('disabled');
    
                } else {
                    alert('Não foi possível realizar a ação entre em contato com a equipe de suporte!');
                }
    
            },
            error: function(error) {
                alert('Error!');
                _objBtn.removeClass('disabled');
                _objBtn.removeAttr('disabled');
            }
        })
    });
    
    $(document).on('submit', '[data-form="psn-restricted-area-atualizar"]', function(event) {
        event.preventDefault();
        _obj = $(this);
        _data = _obj.serialize();
        _objBtn = _obj.find('input[type="submit"]');
        _objBtn.addClass('disabled');
        _objBtn.attr('disabled','disabled');
    
    
        $.ajax({
            url: ajaxForm.ajax_url,
            type: 'POST',
            dataType: 'JSON',
            data: _data,
            beforeSend: function() {
                console.log('Efetuando login');
            },
            success: function(data, stats) {
                // resposta
                $_resposta = data;
                // verifica se existe
                if ($_resposta) {
                    var _cod, _message;
                    // quebrando os resultados
                    // obtendo o cod
                    // _cod = $_resposta.cod;
                    // _message = $_resposta.message;
    
                    console.log($_resposta);
    
                    // $('[data-form="psn-restricted-area"]')[0].reset();
                    _objBtn.removeClass('disabled');
                    _objBtn.removeAttr('disabled');
    
                } else {
                    alert('Não foi possível realizar a ação entre em contato com a equipe de suporte!');
                }
    
            },
            error: function(error) {
                alert('Error!');
                _objBtn.removeClass('disabled');
                _objBtn.removeAttr('disabled');
            }
        })
    });

    $(document).on('submit', '[data-form="psn-restricted-area-atualizar-senha"]', function(event) {
        event.preventDefault();
        _obj = $(this);
        _data = _obj.serialize();
        _objBtn = _obj.find('input[type="submit"]');
        _objBtn.addClass('disabled');
        _objBtn.attr('disabled','disabled');
    
    
        $.ajax({
            url: ajaxForm.ajax_url,
            type: 'POST',
            dataType: 'JSON',
            data: _data,
            beforeSend: function() {
                console.log('Efetuando login');
            },
            success: function(data, stats) {
                // resposta
                $_resposta = data;
                // verifica se existe
                if ($_resposta) {
                    var _cod, _message;
                    // quebrando os resultados
                    // obtendo o cod
                    // _cod = $_resposta.cod;
                    // _message = $_resposta.message;
    
                    console.log($_resposta);
    
                    // $('[data-form="psn-restricted-area"]')[0].reset();
                    _objBtn.removeClass('disabled');
                    _objBtn.removeAttr('disabled');
    
                } else {
                    alert('Não foi possível realizar a ação entre em contato com a equipe de suporte!');
                }
    
            },
            error: function(error) {
                alert('Error!');
                _objBtn.removeClass('disabled');
                _objBtn.removeAttr('disabled');
            }
        })
    });
});