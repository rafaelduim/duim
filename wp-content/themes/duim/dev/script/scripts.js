var $ = jQuery.noConflict();
var widthWindow = $(window).width(), 
    body = $('body'),
    $toastlast = null,
    $toast = '';
var scripts = {
    Init: function() {
        console.log('Start');
        // ============================================================== 
        //This is for preloader
        // ============================================================== 
        $(function () {
            $(".preloader").fadeOut();
        });
        // ============================================================== 
        //Tooltip
        // ============================================================== 
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        // ============================================================== 
        //Popover
        // ============================================================== 
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
        // ============================================================== 
        // Resize all elements
        // ============================================================== 
        $("body").trigger("resize");
        // ============================================================== 
        //Fix header while scroll
        // ============================================================== 
        var wind = $(window);
        wind.on("load", function() {
            var bodyScroll = wind.scrollTop(),
                navbar = $(".topbar");
            if (bodyScroll > 100) {
                navbar.addClass("fixed-header bg-light animated slideInDown")
            } else {
                navbar.removeClass("fixed-header bg-light animated slideInDown")
            }
        });
        $(window).scroll(function () {
            if ($(window).scrollTop() >= 100) {
                $('.topbar').addClass('fixed-header bg-light animated slideInDown');
                $('.bt-top').addClass('visible');
            } else {
                $('.topbar').removeClass('fixed-header bg-light animated slideInDown');
                $('.bt-top').removeClass('visible');
            }
        });
        // ============================================================== 
        // Animation initialized
        // ============================================================== 
        AOS.init();
        // ============================================================== 
        // Back to top
        // ============================================================== 
        $('.bt-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
        // MENU
        $('.tgl-cl').on('click', function() {
            $('body .h17-main-nav').toggleClass("show");
            $('body').toggleClass("active-menu-float");
            
        });
        // $('.h17-main-nav').perfectScrollbar();

        // Recuperar Cidades
        $('#stateForm').change(function(){
            if( $(this).val() ) {
                $.ajax({
                    url: ajaxForm.ajax_url,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {cod_states : $(this).val() , action : 'recovery_cities' },
                    beforeSend: function() {
                        toastr.info('Estamos carregando as cidades','Carregando')
                        $('#cityForm').html('<option>Carregando cidades</option>');
                    },
                    success: function(data, status) {
                        // resposta
                        $_resposta = data;
                        // verifica se existe
                        if ($_resposta) {
                            var _cod, _message;
                            // quebrando os resultados
                            // obtendo o cod
                            _cod = $_resposta.cod;
                            _message = $_resposta.message;
                            _template = $_resposta.template;
    
                            console.log($_resposta);
    
                            if (_cod == 1) {
                                toastr.success('Foram encontrado cidades para o estado selecionado', 'Encontrado')
                                $('#cityForm').html(_template);
                            } else if (_cod == 2) {
                                toastr.error(_message, 'Erro');
                            } else if (_cod == 3) {
                                toastr.error(_message, 'Erro');
                            } else {
                                toastr.error(_message, 'Erro');
                            }
                            
                        } else {
                            alert('Não foi possível carregar as cidades');
                        }
    
                    },
                    error: function(error) {
                        alert('Error!');
                        _objBtn.removeClass('disabled');
                    }
                })
            } else {
                $('[name="cityInscriptions"]').html('<option value="">Selecione o estado</option>');
            }
        });
        // Newsletter
        $('[data-form="psn-newsletter-form"]').submit(function (event) {
            event.preventDefault();
            var $form = $(this)
            var $dataFormContact = $form.serialize();    
            var form_btn = $($form).find('button[type="submit"]');

            var form_btn_old_msg = form_btn.html();
            form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
    
            $.ajax({
                url: ajaxForm.ajax_url,
                type: 'POST',
                dataType: 'JSON',
                data: $dataFormContact,
                beforeSend: function () {
                    toastr["info"]("Estamos enviando a seu e-mail... Aguarde!");
                },
                success: function (data, status) {
                    // resposta
                    var $_resposta = data;
                    // verifica se existe
                    if ($_resposta) {
                        var _cod, _message;
                        // quebrando os resultados
                        // obtendo o cod
                        _cod = $_resposta.stats;
                        _message = $_resposta.message;
                        
                        if (_cod == 1) {                              
                            form_btn.prop('disabled', false).html(form_btn_old_msg);
                            toastr["success"](_message);
                        }else{
                            toastr["error"](_message);
                            form_btn.prop('disabled', false).html(form_btn_old_msg);
                        }
                        $('[data-form="contact"]')[0].reset();
                        
    
                    } else {
                        alert('Não foi possível realizarsua ação');
                    }
    
                },
                error: function (error) {
                    alert('Error!');
                    $('[data-form="psn-newsletter-form"]')[0].reset();
                    toastr["error"](_message);
                }
            });
    
        });
        // Register
        $('[data-form="psn-restricted-area-cadastro"]').submit(function (event) {
            event.preventDefault();
            var $button = $(this).find('button[type="submit"]');
            var $form = $(this)
            var $dataFormContact = $form.serialize();
            $.ajax({
                url: ajaxForm.ajax_url,
                type: 'POST',
                dataType: 'JSON',
                data: $dataFormContact,
                beforeSend: function () {
                    $button.addClass("enviando");
                    $button.attr('disabled','disabled');
                    // notificacaoInformacao('Enviando', "Estamos enviando a sua solicitacao... Aguarde!");
                    toastr["info"]("Estamos enviando a sua solicitacao... Aguarde!");
                },
                success: function (data, status) {
                    var _cod,
                        _mensagem;
                                          
                    toastr.clear();
                    $button.removeAttr('disabled');
                    _cod = data.cod;
                    _mensagem = data.mensagem;
                    if (_cod == 0) {
                        toastr["error"](_mensagem);

                        $('[data-form="area-restrita-cadastro"]')[0].reset();

                    } else {
                        toastr["success"]("Foi enviado um e-mail de confirmação para você!");
                        $('[data-form="area-restrita-cadastro"]')[0].reset();
                    }

                },
                error: function (error) {
                    alert('Error!');
                    $('[data-form="area-restrita-cadastro"]')[0].reset();
                    notificationError('Error', error);
                }
            });

        });
        // LOAD
        $('[data-load="ajax"]').each(function () {
            var _o = $(this);
            var _p = _o.data('parametros');
            var _container = '#' + _o.attr('id');
            var _data = eval('({' + _p + '})');
            carregarAjaxConteudo(_data, _container);
        });
        $(document).on('click',"[data-acao-ajax='true']",function(e){
            e.preventDefault();
            var _o = $(this);
            if(!_o.parent('li').hasClass('active')) {
                _o.parents('.nav-pills').find('.active').removeClass('active');
                _o.parent('li').addClass('active')
                var _p = _o.data('parametros');
                var _container = _o.data('container');
                var _data = eval('({' + _p + '})');
                $(_container).html('<div class="container-load pt-100 pb-100"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>');
                carregarAjaxConteudo(_data, _container);
            }
        })
    
        function carregarAjaxConteudo(_data, local) {
            $.ajax(
            {
                url: ajaxForm.ajax_url,
                type: 'POST',
                data: _data,
                dataType: "HTML",
                success: function (results, status) {
                    if (results == 0) {
                        // $(local).html('<div class="sem-conteudo">Não foram encontrados resultados</div>');
                        $(local).html('');
                    } else {
                        $(local).html(results);
                    }
                }
            });
        }
    }
}

$(window).on('load', function() {
    scripts.Init();
    // $('body .page').scroll(navSlide);
});
