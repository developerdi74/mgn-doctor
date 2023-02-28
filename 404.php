<?require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
CHTTP::SetStatus('404 Not Found');
$APPLICATION->SetTitle("Страница не найдена");
?>
<div id="page" class="site ">
 <section class="error-404 testing">
   <div class="container"> 
     <div class="row row-error-404">
         <h1 class="page-title error-404__title">
           <svg width="656" height="267" viewBox="0 0 656 267" fill="none" xmlns="http://www.w3.org/2000/svg">
           <path fill-rule="evenodd" clip-rule="evenodd" d="M203.5 209.79H177.6V259.37H105.82L105.631 209.79H0V162.06L69.19 0L131.72 22.2L75.11 155.77H106.353L114.7 101.01H177.6V155.77H203.5V209.79ZM326.587 1.85C391.707 1.85 427.967 48.84 427.967 133.94C427.967 218.67 391.707 266.77 326.587 266.77C261.467 266.77 225.207 218.67 225.207 133.94C225.207 48.84 261.467 1.85 326.587 1.85ZM326.587 54.76C306.237 54.76 299.947 71.78 299.947 133.94C299.947 196.47 306.237 213.49 326.587 213.49C346.937 213.49 353.227 198.69 353.227 133.94C353.227 68.82 346.937 54.76 326.587 54.76ZM655.023 209.79H629.123V259.37H557.343L557.155 209.79H451.523V162.06L520.713 0L583.243 22.2L526.633 155.77H557.876L566.223 101.01H629.123V155.77H655.023V209.79Z" fill="#2C3E50" fill-opacity="0.1"/>
           </svg>
           <div>Страница не найдена</div>
         </h1>
         <div class="error-404__btn">
           <a href="/" class="btn btn-return">Вернуться на сайт</a>
         </div>
     </div>
   </div>
 </section>
</div>
<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>