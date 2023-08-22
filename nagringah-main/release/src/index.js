import './sass/main.scss'
import $ from 'jquery';

$(document).ready(function(){
    setTimeout(function(){
        $(".shipping_address.buyFriend #shipping_first_name").val($('#first_nameReference').val());
        $(".shipping_address.buyFriend #shipping_last_name").val($('#last_nameReference').val());
        $(".shipping_address.buyFriend #shipping_address_1").val($('#address_1Reference').val());
        $(".shipping_address.buyFriend #shipping_address_2").val($('#address_2Reference').val());
        $(".shipping_address.buyFriend #shipping_city").val($('#cityReference').val());
        $(".shipping_address.buyFriend #shipping_state").val($('#stateReference').val()).change();
        $(".shipping_address.buyFriend #shipping_postcode").val($('#postcodeReference').val());
    }, 1000);

    //button logged
    $(".envolve .button-logged").click(function(){
        $(".menu-list").toggleClass("active");
    });

    $("#reg_email").focusout(function() {
        var data = {
            data: $(this).val()
        }

        $.ajax({
            method: "POST",
            url: "https://nagringah.com.br/api/keypress.php",
            data: data,
            dataType: "json",
            beforeSend : function(){
                
            }
        }).done(function(resultado){
            if(resultado.error==1){
                $('label[for="reg_email"]').html('Endereço de e-mail&nbsp; <span class="required">*</span> <div style="padding: 3px 10px; background-color: #f1adad; border-color: #e35b5b; margin-bottom: 5px;">Este email já está em uso!</div>');
                $('button[name="register"]').attr("disabled", "true");
            }else{
                $('label[for="reg_email"]').html('Endereço de e-mail&nbsp; <span class="required">*</span>');
            }
        });
    });
    

});

window.onload = function() {
    $(document).ready(function(){
        //request friend
        $(".request-friend").click(function(){
            $(this).attr("disabled", true);
            $(".request-friend").html("<span>Solicitação enviada!</span>");
        });

        $(".pm-notification-view-area .pm-notification-buttons").on("click", "a", function(){
            location.href = "https://nagringah.com.br/lista-de-amigos/";
        });

        //close cat
        $("#close-cat").click(function(){
            $(".molti-dropdown-2-content").toggleClass("hide-dp");
            $(".molti-dropdown-2").toggleClass("active");
        });

        //account area
        $(".moc .pm-dbfl a").click(function(e){
            var ref = $(this).attr("href");
            $(".pm-section-right-panel .pm-blog-desc-wrap").removeClass("active");
            $(".pm-section-right-panel "+ref).addClass("active");
            e.preventdefault();
        });

        //habilista listagem de usuários
        $('form#pm-advance-search-form .pm-search-input').keyup(function(){
            var inputValue = $(this).val();
            if(inputValue!=""){
                $("#pm_result_pane").addClass("active");
            }else{
                $("#pm_result_pane").removeClass("active");
            }
        })

        $('.login-page form button[type="submit"]').attr("disabled", true);
        //
        $('.login-page form input[type="password"]').keyup(function(){
            $('.login-page form button[type="submit"]').attr("disabled", false);
        })
    });

    // Início Upload banner 
    if(document.getElementById("cropcoverimage")) {
        const coverImg = document.getElementById("coverimg");
        let label = document.getElementById("cropcoverimage").firstElementChild;
    
        coverImg.addEventListener('change', () => {
            label.textContent = "";
            label.textContent = coverImg.value;
        })
    }
    // Final Upload banner 

    // Início Upload foto de perfil 
    if(document.getElementById("cropimage")) {
        const perfilImg = document.getElementById("photoimg");
        const pm = document.getElementById("cropimage").firstElementChild;
        let labelPerfil = pm.firstElementChild;
        console.log(perfilImg, pm, labelPerfil);
        perfilImg.addEventListener('change', () => {
            console.log('change')
            labelPerfil.textContent = "";
            labelPerfil.textContent = perfilImg.value;
        })
    }
    // Final Upload foto de perfil 
    

    if(document.querySelector(".wshkreviewcontainer")) {
        loaderReviews();
    }
    if(window.location.href !== 'https://nagringah.com.br/meu-perfil/' && document.getElementById('pm-change-image')) {
        console.log(window.location.href)
        const profileImg = document.getElementById('pm-change-image').parentElement;
        console.log(profileImg)
        profileImg ? profileImg.setAttribute('style', 'display: none !important;') : profileImg.setAttribute('style', 'display: flex!important;')
        profileImg ? profileImg.firstElementChild.style.display = 'none!important' : profileImg.firstElementChild.style.display = 'flex!important'
    }

    //Início tradução reset-password

    if(document.getElementById('lostpasswordform')) {
        const resetPasswordFields = document.getElementById('lostpasswordform').firstElementChild.children;
        console.log(resetPasswordFields)
        resetPasswordFields[0].textContent = "Recupere sua senha"
        resetPasswordFields[1].firstElementChild.textContent = "Por favor digite seu endereço de e-mail e sua senha. Você irá receber um link para criar uma nova senha no seu email."
        resetPasswordFields[2].firstElementChild.textContent = "Endereço de email ou nome de usuário"
        resetPasswordFields[3].children[4].textContent = "Recuperar senha"
    }
  
    //Final tradução reset-password
}

// Início Avaliações

const imageReview = [];
const productName = [];
const ownerName = [];
const createdAt = [];
const reviewContent = [];
const reviewLink = [];
const starsReview = [];
let errorMessage;

async function loaderReviews() {
    await createLoading();
    await setReviewContent();
    const allLoader = document.querySelectorAll('.review-loader')
    for(let loader of allLoader) {
        loader.classList.add('hide')
    }
}

async function createLoading() {
    let loader = false;
    const createLoader = new Promise(
        function(resolve, reject) {

            if(document.querySelector(".wshkreviewcontainer")) {
                const reviewsContainer = document.querySelectorAll(".wshkreviewcontainer");
                for(let review of reviewsContainer) {
                    review.style.position = "relative";
                    review.firstElementChild.classList.add("hide")
                    const loader = document.createElement('div')
                    loader.classList.add('review-loader')
                    review.appendChild(loader)

                    getReviewComponent(review.firstElementChild);
                }
                resolve(loader = true);
                console.log(loader);
            } else {
                reject(loader = false);
                console.log(loader)
            }
        }
    )
}


async function getReviewComponent(review) {
    const getReview = new Promise(
        function(resolve, reject) {
            try {
                // console.log(review.children) 
                for(let rev of review.children) {
                    const imageElement = rev.firstElementChild.firstElementChild.firstElementChild;
                    const infoElement = rev.firstElementChild.firstElementChild.children[1];
                    const contentElement = rev.parentElement;
                 
                    resolve(
                        imageReview.push(imageElement.firstElementChild),
                        starsReview.push(infoElement.children[0].firstElementChild.firstElementChild),
                        productName.push(infoElement.children[1]),
                        ownerName.push(infoElement.children[3]),
                        createdAt.push(infoElement.children[5]),
                        reviewContent.push(contentElement.children[1].textContent.toString()),
                        reviewLink.push(contentElement.children[4])
                    )
                   
                    createReviewContent(contentElement)
                }
            } catch (error) {
                reject(errorMessage = error)
            }
        }
    )
}

async function createReviewContent(el) {
    const createReview = new Promise(
        function(resolve, reject) {
            try {
                let index = 0;
                const element = el.parentElement;
                element.classList.add('nagringah-review');
                element.classList.remove('wshkreviewcontainer');
                const mainReview = element.parentElement
                mainReview.classList.add('nagringah-main-review')
                mainReview.parentElement.parentElement.firstElementChild.firstElementChild.firstElementChild.textContent = "Minhas Avaliações"
                mainReview.parentElement.parentElement.firstElementChild.firstElementChild.firstElementChild.style.fontSize = "16px"
                
                const masterReview = document.createElement('div');
                masterReview.classList.add('nagringah-master-review');
                element.appendChild(masterReview);
                const previewReview = document.createElement('div');
                previewReview.classList.add('nagringah-preview-review');
                masterReview.appendChild(previewReview);
                const contentReview = document.createElement('div');
                contentReview.classList.add('nagringah-content-review');
                mainReview.appendChild(contentReview);

                index++;
            } catch (error) {
                console.log(error)
            }
        }
    )
}

async function setReviewContent() {
    const previewReview = document.querySelectorAll(".nagringah-preview-review");
    let i = 0;
    let m = 0;
    for(let preview of previewReview) {        
        const mainReview = preview.parentElement.parentElement;
        mainReview.id = "review"+i
        mainReview.addEventListener('click', event => enableReviewContent(event))

        preview.appendChild(imageReview[i])
        imageReview[i].classList.remove('mcon-image-container')
        imageReview[i].classList.add('nagringah-review-image')

        const infoOwner = document.createElement('div')
        infoOwner.classList.add('nagringah-info-owner')
        preview.appendChild(infoOwner)
        infoOwner.appendChild(ownerName[i])
        infoOwner.appendChild(createdAt[i])

        i++;
    }

    const mainReview = document.querySelectorAll('.nagringah-content-review')

    for(let main of mainReview) {
        const masterReview = main;
        if(m > 0) {
            masterReview.classList.add('hide-content')
        }
        masterReview.id = "content"+m;
        masterReview.appendChild(productName[m])
        let stars = parseInt(starsReview[m].textContent)
        let starsContent = document.createElement('div')
        starsContent.classList.add('stars-content')
        for(let n = 0; n < stars; n++) {
            const img = document.createElement('img');
            img.setAttribute('src', '../wp-content/themes/Divi/dist/img/star.svg')
            starsContent.appendChild(img)
        }
        masterReview.appendChild(starsContent)
        masterReview.appendChild(document.createElement('hr'))
        const contentBox = document.createElement('div')
        const content = document.createElement('p')
        content.innerHTML = reviewContent[m]
        contentBox.appendChild(content)
        masterReview.appendChild(content)
        m++;
    }
}

function enableReviewContent(event) {
        let currentReview = event.currentTarget.id
        let index = currentReview[currentReview.length-1]

        const allContent = document.querySelectorAll('.nagringah-content-review')
        let currentContent = document.getElementById('content'+index)
        console.log(currentContent, allContent)
        for(let main of allContent) {
            if(main.id !== currentContent.id) {
                main.classList.add('hide-content')
            } else {
                main.classList.remove('hide-content')
            }
        }
    
}
//Final Avaliações
