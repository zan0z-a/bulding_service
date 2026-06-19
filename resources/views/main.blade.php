@extends('layouts.layout')

@section('title', 'ServiceName — Поставки промышленного оборудования')

@push('scripts')
{!! NoCaptcha::renderJs() !!}
@endpush

@section('content')

<section class="hero-section">
  <div class="hero-bg"></div>
  <div class="hero-diagonal"></div>
  <div class="hero-accent-line"></div>
  <div class="container hero-content py-5">
    <div class="row">
      <div class="col-lg-7">
        <div class="hero-eyebrow">Надёжный поставщик с 2012 года</div>
        <h1 class="hero-title">ПОСТАВКИ<br><span class="hl">ПРОМЫШЛЕННОГО</span><br>ОБОРУДОВАНИЯ</h1>
        <p class="hero-subtitle">Металлопрокат, кабельная продукция, промышленные станки и запасные части. Прямые поставки от производителей по всей России и СНГ.</p>
        <div class="d-flex flex-wrap gap-3">
          <a href="#catalog" class="btn-hero-primary">Перейти в каталог</a>
          <a href="#contact" class="btn-hero-ghost">Связаться с нами</a>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="stats-row">
  <div class="container">
    <div class="row g-0">
      <div class="col-6 col-md-3 py-2"><div class="stat-item"><div class="stat-num">12+</div><div class="stat-label">лет на рынке</div></div></div>
      <div class="col-6 col-md-3 py-2"><div class="stat-item"><div class="stat-num">800+</div><div class="stat-label">наименований</div></div></div>
      <div class="col-6 col-md-3 py-2"><div class="stat-item"><div class="stat-num">500+</div><div class="stat-label">клиентов по РФ</div></div></div>
      <div class="col-6 col-md-3 py-2"><div class="stat-item"><div class="stat-num">24ч</div><div class="stat-label">обработка заявки</div></div></div>
    </div>
  </div>
</div>

<section class="catalog-section" id="catalog">
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-6">
        <span class="section-eyebrow">Ассортимент</span>
        <h2 class="section-title">ОСНОВНЫЕ НАПРАВЛЕНИЯ</h2>
        <div class="divider-accent"></div>
        <p class="section-lead">Мы работаем с ведущими производителями и дистрибьюторами — широкий ассортимент всегда в наличии или под заказ в кратчайшие сроки.</p>
      </div>
    </div>
    <div class="row g-4">
      @foreach(['Промышленные станки' => '1558618666-fcd25c85cd64', 'Металлопрокат' => '1504917595217-d4dc5ebe6122', 'Кабельная продукция' => '1555664424-778a1e5e1b48', 'Энергетическое оборудование' => '1581092918056-0c4c3acd3789', 'Запасные части' => '1586528116311-ad8dd3c8310d', 'Подъёмное оборудование' => '1504328345606-18bbc8c9d7d1'] as $title => $img)
      <div class="col-sm-6 col-lg-4">
        <div class="cat-card">
          <div class="cat-card-img"><img src="https://images.unsplash.com/photo-{{ $img }}?w=600&q=80" alt="{{ $title }}"></div>
          <div class="cat-card-body">
            <div class="cat-card-title">{{ $title }}</div>
            <p class="cat-card-desc">Описание категории.</p>
            <a href="#contact" class="cat-card-link">Узнать цену <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<section class="why-section" id="about">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-5">
        <div class="why-img-wrap">
          <img src="https://images.unsplash.com/photo-1565793298595-6a879b1d9492?w=700&q=80" alt="Склад">
          <div class="why-img-badge">12<small>лет<br>опыта</small></div>
        </div>
      </div>
      <div class="col-lg-7">
        <span class="section-eyebrow">Почему мы</span>
        <h2 class="section-title">НАДЁЖНЫЙ ПАРТНЁР ДЛЯ ВАШЕГО ПРОИЗВОДСТВА</h2>
        <div class="divider-accent"></div>
        <p class="section-lead mb-4">ООО «ServiceName» — российская компания с 2012 года.</p>
        <div class="why-item"><div class="why-icon"><i class="bi bi-truck"></i></div><div><div class="why-item-title">Прямые поставки без посредников</div><p class="why-item-desc">Работаем с производителями напрямую.</p></div></div>
        <div class="why-item"><div class="why-icon"><i class="bi bi-speedometer2"></i></div><div><div class="why-item-title">Короткие сроки поставки</div><p class="why-item-desc">Собственный складской запас.</p></div></div>
        <div class="why-item"><div class="why-icon"><i class="bi bi-headset"></i></div><div><div class="why-item-title">Техническая поддержка</div><p class="why-item-desc">Инженеры помогут подобрать оборудование.</p></div></div>
        <div class="why-item"><div class="why-icon"><i class="bi bi-patch-check"></i></div><div><div class="why-item-title">Гарантия и сертификация</div><p class="why-item-desc">Работаем по договору с НДС.</p></div></div>
      </div>
    </div>
  </div>
</section>

<section class="process-section">
  <div class="container">
    <div class="row mb-5"><div class="col-lg-6"><span class="section-eyebrow">Как мы работаем</span><h2 class="section-title">ПРОСТОЙ ПРОЦЕСС ЗАКАЗА</h2><div class="divider-accent"></div></div></div>
    <div class="row g-4">
      <div class="col-sm-6 col-lg-3"><div class="process-step"><div class="step-num">01</div><div class="step-title">Заявка</div><p class="step-desc">Оставьте заявку на сайте.</p></div></div>
      <div class="col-sm-6 col-lg-3"><div class="process-step"><div class="step-num">02</div><div class="step-title">Расчёт</div><p class="step-desc">Менеджер свяжется с вами.</p></div></div>
      <div class="col-sm-6 col-lg-3"><div class="process-step"><div class="step-num">03</div><div class="step-title">Договор</div><p class="step-desc">Подписываем договор поставки.</p></div></div>
      <div class="col-sm-6 col-lg-3"><div class="process-step"><div class="step-num">04</div><div class="step-title">Доставка</div><p class="step-desc">Отгрузка со склада.</p></div></div>
    </div>
  </div>
</section>

<section class="gallery-section">
  <div class="container">
    <div class="row mb-4"><div class="col-lg-6"><span class="section-eyebrow">Производство и склад</span><h2 class="section-title">НАШИ МОЩНОСТИ</h2><div class="divider-accent"></div></div></div>
    <div class="gallery-grid">
      <div class="g-item big"><img src="https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=600&q=80" alt="Склад"></div>
      <div class="g-item"><img src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=600&q=80" alt="Оборудование"></div>
      <div class="g-item"><img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=500&q=80" alt="Цех"></div>
      <div class="g-item"><img src="https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=500&q=80" alt="Инженер"></div>
      <div class="g-item"><img src="https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=600&q=80" alt="Металлопрокат"></div>
    </div>
  </div>
</section>

<section class="clients-section">
  <div class="container">
    <div class="text-center mb-4"><span class="section-eyebrow">Нас выбирают</span><h3 style="font-family:'Bebas Neue',sans-serif;font-size:1.8rem;color:var(--navy);">НАШИ КЛИЕНТЫ И ПАРТНЁРЫ</h3></div>
    <div class="row justify-content-center align-items-center g-4">
      @foreach(['ЗАВОД А','МЕТКОМ','СТРОЙГРУП','РОСЭНЕРГО','ПРОМТЕХ','ТЕХСНАБ'] as $client)
      <div class="col-6 col-sm-4 col-md-2 client-logo"><div class="client-logo-text">{{ $client }}</div></div>
      @endforeach
    </div>
  </div>
</section>

<section class="cta-section">
  <div class="cta-bg"></div>
  <div class="container" style="position:relative;z-index:2;">
    <div class="row align-items-center">
      <div class="col-lg-7 mb-4 mb-lg-0">
        <h2 class="section-title">НУЖНА КОНСУЛЬТАЦИЯ ИЛИ КОММЕРЧЕСКОЕ ПРЕДЛОЖЕНИЕ?</h2>
        <p class="mt-3">Свяжитесь с нами — специалист ответит в течение рабочего дня.</p>
      </div>
      <div class="col-lg-5 text-lg-end">
        <div class="d-flex flex-wrap gap-3 justify-content-lg-end">
          <a href="#contact" class="btn-cta-white">Оставить заявку</a>
          <a href="tel:88009999999" class="btn-cta-outline"><i class="bi bi-telephone me-2"></i>8 800 999-99-99</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="contact-section" id="contact">
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-6">
        <span class="section-eyebrow">Связаться с нами</span>
        <h2 class="section-title">КОНТАКТЫ</h2>
        <div class="divider-accent"></div>
      </div>
    </div>
    <div class="row g-5">
      <div class="col-lg-6">
        <div class="form-card">
          <h3 style="font-family:'Bebas Neue',sans-serif;font-size:1.6rem;color:var(--navy);letter-spacing:0.04em;margin-bottom:1.5rem;">Оставить заявку</h3>
          
          <form id="contactForm" novalidate>
            @csrf
            
            <div class="mb-3">
              <div class="form-label-custom">Ваше имя *</div>
              <input type="text" name="name" class="form-control-custom" placeholder="Иванов Иван Иванович" required>
            </div>
            
            <div class="mb-3">
              <div class="form-label-custom">Компания</div>
              <input type="text" name="company" id="companyInput" class="form-control-custom" placeholder="ООО «Название»">
              <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" name="no_company" id="noCompanyCheck" value="1">
                <label class="form-check-label" for="noCompanyCheck" style="font-size:0.85rem;color:#64748b;cursor:pointer;user-select:none;">
                  У меня нет компании
                </label>
              </div>
            </div>
            
            <div class="mb-3">
              <div class="form-label-custom">E-mail *</div>
              <input type="email" name="email" class="form-control-custom" placeholder="mail@company.ru" required>
            </div>
            
            <div class="mb-4">
              <div class="form-label-custom">Что вас интересует?</div>
              <textarea name="message" class="form-control-custom" placeholder="Опишите потребность..." rows="4"></textarea>
            </div>
            
            <div class="mb-3" id="captchaContainer">
              {!! NoCaptcha::display() !!}
            </div>
            
            <button type="submit" class="btn-submit" id="submitBtn">
              Отправить заявку <i class="bi bi-send ms-2"></i>
            </button>
            
            <div class="success-toast" id="successToast">
              <i class="bi bi-check-circle me-2"></i>Заявка отправлена! Мы свяжемся с вами в течение 24 часов.
            </div>
            
            <div id="errorToast" style="display:none;background:#dc2626;color:white;padding:12px 20px;border-radius:4px;font-size:0.9rem;font-weight:600;margin-top:12px;">
              <i class="bi bi-exclamation-triangle me-2"></i><span id="errorMessage">Ошибка отправки.</span>
            </div>
            
            <p style="font-size:0.75rem;color:#94a3b8;margin-top:10px;">
              Нажимая кнопку, вы соглашаетесь с политикой конфиденциальности
            </p>
          </form>
        </div>
      </div>
      
      <div class="col-lg-6">
        <div class="contact-info-item">
          <div class="contact-icon"><i class="bi bi-telephone-fill"></i></div>
          <div><div class="contact-info-label">Телефон (бесплатно)</div><div class="contact-info-value"><a href="tel:88009999999">8 800 999-99-99</a></div></div>
        </div>
        <div class="contact-info-item">
          <div class="contact-icon"><i class="bi bi-envelope-fill"></i></div>
          <div><div class="contact-info-label">Электронная почта</div><div class="contact-info-value"><a href="mailto:info@servicename-group.ru">info@servicename-group.ru</a></div></div>
        </div>
        <div class="contact-info-item">
          <div class="contact-icon"><i class="bi bi-geo-alt-fill"></i></div>
          <div><div class="contact-info-label">Офис и склад</div><div class="contact-info-value">Москва, ул. Пушкина, д. 10, стр. 2</div></div>
        </div>
        <div class="contact-info-item">
          <div class="contact-icon"><i class="bi bi-clock-fill"></i></div>
          <div><div class="contact-info-label">Режим работы</div><div class="contact-info-value">Пн–Пт: 9:00–18:00<br><span style="font-size:0.82rem;color:#94a3b8;">Сб–Вс: выходной</span></div></div>
        </div>
        <div class="map-placeholder mt-3">
          <iframe src="https://yandex.com/map-widget/v1/?ll=53.207017%2C56.852755&z=13" width="100%" height="260" style="border:0;display:block;" allowfullscreen="true"></iframe>
        </div>
        <div class="d-flex gap-3 mt-4">
          <a href="#" style="color:var(--steel);font-size:1.6rem;"><i class="bi bi-whatsapp"></i></a>
          <a href="#" style="color:var(--steel);font-size:1.6rem;"><i class="bi bi-telegram"></i></a>
          <a href="mailto:info@servicename-group.ru" style="color:var(--steel);font-size:1.6rem;"><i class="bi bi-envelope-fill"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
(function() {
    var isSubmitting = false;
    var noCompanyCheck = document.getElementById('noCompanyCheck');
    var companyInput = document.getElementById('companyInput');
    
    if (noCompanyCheck && companyInput) {
        noCompanyCheck.addEventListener('change', function() {
            if (this.checked) {
                companyInput.value = '';
                companyInput.disabled = true;
                companyInput.placeholder = 'Не указана';
                companyInput.style.opacity = '0.5';
                companyInput.style.backgroundColor = '#e9ecef';
            } else {
                companyInput.disabled = false;
                companyInput.placeholder = 'ООО «Название»';
                companyInput.style.opacity = '1';
                companyInput.style.backgroundColor = '';
            }
        });
    }

    function handleSubmit(e) {
        e.preventDefault();
        e.stopPropagation();
        
        if (isSubmitting) {
            return false;
        }
        
        var form = document.getElementById('contactForm');
        var submitBtn = document.getElementById('submitBtn');
        var successToast = document.getElementById('successToast');
        var errorToast = document.getElementById('errorToast');
        var errorMessage = document.getElementById('errorMessage');

        if (typeof grecaptcha !== 'undefined') {
            var captchaResponse = grecaptcha.getResponse();
            if (!captchaResponse || captchaResponse.length === 0) {
                errorMessage.textContent = 'Пожалуйста, подтвердите, что вы не робот (пройдите капчу).';
                errorToast.style.display = 'block';
                setTimeout(function() {
                    errorToast.style.display = 'none';
                }, 5000);
                return false;
            }
        }

        successToast.style.display = 'none';
        errorToast.style.display = 'none';

        isSubmitting = true;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Отправка...';

        var formData = new FormData(form);

        fetch('/contact/send', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(function(response) { 
            return response.json(); 
        })
        .then(function(data) {
            if (data.success) {
                successToast.style.display = 'block';
                errorToast.style.display = 'none';
                
                form.reset();
                
                if (typeof grecaptcha !== 'undefined') {
                    grecaptcha.reset();
                }
                
                if (noCompanyCheck && companyInput) {
                    noCompanyCheck.checked = false;
                    companyInput.disabled = false;
                    companyInput.placeholder = 'ООО «Название»';
                    companyInput.style.opacity = '1';
                    companyInput.style.backgroundColor = '';
                }
                
                form.scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else {
                successToast.style.display = 'none';
                errorMessage.textContent = data.message || 'Ошибка отправки. Позвоните нам: 8 800 999-99-99';
                errorToast.style.display = 'block';
                
                if (typeof grecaptcha !== 'undefined') {
                    grecaptcha.reset();
                }
            }
        })
        .catch(function(error) {
            console.error('Ошибка:', error);
            successToast.style.display = 'none';
            errorMessage.textContent = 'Ошибка соединения. Попробуйте позже.';
            errorToast.style.display = 'block';
            
            if (typeof grecaptcha !== 'undefined') {
                grecaptcha.reset();
            }
        })
        .finally(function() {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Отправить заявку <i class="bi bi-send ms-2"></i>';
            
            setTimeout(function() {
                successToast.style.display = 'none';
                errorToast.style.display = 'none';
            }, 6000);
            
            setTimeout(function() {
                isSubmitting = false;
            }, 1000);
        });
        
        return false;
    }

    var contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.removeEventListener('submit', handleSubmit);
        contactForm.addEventListener('submit', handleSubmit);
    }

})();
</script>
@endpush
