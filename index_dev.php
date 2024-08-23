<?php
// nonce generation
function generateNonce() {
    return bin2hex(random_bytes(16));
}

// nonce generation fof csp header
$nonce = generateNonce();

$cspFromHtaccess = "default-src 'self' https://unpkg.com/ https://www.google.com https://fonts.googleapis.com https://fonts.gstatic.com data: blob: https://va.tawk.to wss://vsa111.tawk.to https://www.googletagmanager.com/ https://*.tawk.to/ https://*.jsdelivr.net/; media-src https://*.tawk.to/; style-src 'self' https://platform.illow.io/ https://www.googletagmanager.com/ https://unpkg.com/ https://fonts.googleapis.com https://embed.tawk.to https://*.jsdelivr.net/ 'unsafe-inline'; font-src 'self' https://platform.illow.io/ https://*.jsdelivr.net/ https://fonts.gstatic.com https://*.tawk.to/ 'unsafe-inline' data:; img-src https://fonts.gstatic.com/ https://www.googletagmanager.com/ https://unpkg.com/ https://*.jsdelivr.net/ https://*.tawk.to/ https://*.tile.openstreetmap.org/ 'self' data:; connect-src 'self' https://googleads.g.doubleclick.net/ https://www.google.com/ https://api.platform.illow.io/ https://platform.illow.io/ https://region1.google-analytics.com/ wss://vsa92.tawk.to/ https://vsa111.tawk.to https://vsa59.tawk.to wss://*.tawk.to https://*.tawk.to; frame-src https://www.googletagmanager.com/;";
$scriptSrc = "'self' https://*.jsdelivr.net/ https://unpkg.com/ https://googletagmanager.com/ https://www.googletagmanager.com/ https://embed.tawk.to/ 'unsafe-eval' 'nonce-$nonce' ";
$cspWithNonce = $cspFromHtaccess . " script-src $scriptSrc;";
$cspWithNonce = str_replace(array("\r", "\n"), '', $cspWithNonce);
header("Content-Security-Policy: $cspWithNonce");
?>

<!DOCTYPE html>
<html lang="pl">
  <head>

    <!-- Google Tag Manager -->
 
    <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
      (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-TZNTG6D7');
    </script> 

    <!-- End Google Tag Manager -->

    <!-- Google tag (gtag.js) analitics-->

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DLNE5W9MZ7" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>"></script>
    <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-DLNE5W9MZ7');
        
      // Function to send data to Google Analytics
      function sendEventToAnalytics(eventCategory, eventLabel, eventValue) {
        gtag('event', eventCategory, {
          'event_category': 'engagement',
          'event_label': eventLabel,
          'value': eventValue // time in milliseconds
        });
        console.log(`Event: ${eventCategory}, Label: ${eventLabel}, Value: ${eventValue}ms`);
      }
    
      // Track time spent on the page
      let pageEnterTime = new Date().getTime();
    
      window.addEventListener('beforeunload', function() {
        let pageLeaveTime = new Date().getTime();
        let timeSpentOnPage = (pageLeaveTime - pageEnterTime)/1000 ;
        sendEventToAnalytics('time_spent_on_page', 'Total Time on Page', timeSpentOnPage);
      });
    
      
      // Track time spent on each section
      document.addEventListener('DOMContentLoaded', (event) => {
      const sections = document.querySelectorAll('section');
      const sectionsTimeData = {};

      sections.forEach(section => {
        sectionsTimeData[section.id] = { startTime: 0, totalTimeSpent: 0 };
      });
    
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          const sectionId = entry.target.id;
          if (entry.isIntersecting) {
            sectionsTimeData[sectionId].startTime = new Date().getTime();
          } else {
            const startTime = sectionsTimeData[sectionId].startTime;
            if (startTime) {
              const endTime = new Date().getTime();
              const timeSpent = endTime - startTime;
              sectionsTimeData[sectionId].totalTimeSpent += timeSpent;
              sectionsTimeData[sectionId].startTime = 0;
            }
          }
        });
      }, {
        threshold: 0.5
      });
    
      sections.forEach(section => {
        observer.observe(section);
      });
    
      window.addEventListener('beforeunload', () => {
        sections.forEach(section => {
          const sectionId = section.id;
          const startTime = sectionsTimeData[sectionId].startTime;
          if (startTime) {
            const endTime = new Date().getTime();
            const timeSpent = endTime - startTime;
            sectionsTimeData[sectionId].totalTimeSpent += timeSpent;
          }
          sendEventToAnalytics('time_spend_on_section', sectionId, (sectionsTimeData[sectionId].totalTimeSpent) / 1000); // Convert to seconds
        });
      });
    });
    </script>


    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Zdjęcia produktowe- packshoty, aranżacje, home stage-Cennik</title>
    <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "Cennik",
        "url": "https://pixelum.pl/index.php#services",
        "description": "Sprawdź nasz cennik usług i produktów."
      }
    </script>
    <meta name="description" content="Studio fotograficzne Pixelum - wyjątkowe sesje zdjęciowe dla twoich produktów, szybka i profesjonalna współpraca. Packshoty, wizualizacje i animacje 3D, obróbka zdjęć." />
    <meta property="og:title" content="Zdjęcia produktowe packshot i aranżacje">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://www.pixelum.pl/assets/img/hero-bg.webp">
    <meta property="og:url" content="https://www.pixelum.pl">
    <meta property="og:description" content="Studio fotograficzne Pixelum - wyjątkowe sesje zdjęciowe dla twoich produktów, szybka i profesjonalna współpraca">
    <link rel="canonical" href="https://pixelum.pl/index.php">
    
    <!-- inject:css -->
    <!-- endinject:css -->

  </head>

  <body>
    <!-- Google Tag Manager (noscript) -->
      <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TZNTG6D7"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> 
    <!-- End Google Tag Manager (noscript) -->

    <!-- ======= Nagłówek ======= -->
    <header id="header" class="fixed-top">
      <div class="container d-flex align-items-center justify-content-lg-between">
        <span class="logo me-sm-auto me-lg-0">
          <a href="/index.html">Pixelum<span>.</span></a>
        </span>

        <div class="mx-2 fs-6">
          <a href="mailto:office@pixelum.pl">office@pixelum.pl</a><br />
          <span>
            <a href="tel:+48604216600"  class="text-white">+48 604216600</a>
          </span>
        </div>

<!--        <div id="language-switch">-->
<!--          <a href="index_eng.html">Eng</a>-->
<!--        </div>-->

        <nav id="navbar" class="navbar order-last order-lg-0 ms-auto">
          <i class="mobile-nav-toggle">
            <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon"><path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path></svg>
          </i>
          <ul>
            <li>
              <a class="nav-link scrollto active" href="#hero">Start</a>
            <li>
              <a class="nav-link scrollto" href="#about">O nas</a>
            </li>
            </li>
            <li>
              <a class="nav-link scrollto" href="#portfolio">Portfolio</a>
            </li>
            <li>
              <a class="nav-link scrollto" href="#services">Cennik</a>
            </li>
            <li>
              <a class="nav-link scrollto" href="#team">Zespół</a>
            </li>
            <li>
              <a class="nav-link scrollto" href="#contact">Kontakt</a>
            </li>
          </ul>
        </nav>
        <!-- .navbar -->
      </div>
    </header>
    <!-- Koniec nagłówka -->

    <!-- ======= Sekcja Hero ======= -->
    <section id="hero" class="d-flex align-items-center justify-content-center track-section">
      <div class="container" itemscope itemtype="https://schema.org/Service">
        <div class="row">
          <div class="col-12">
            <h1 class="hero__header">Zdjęcia produktowe<span class="hero__header--yellow">.</span></h1>
            <h2 class="hero__subheader">
              Twoja wizja, nasze zaangażowanie. <br />
              Zawsze dostosowani do Ciebie!
            </h2>
          </div>
        </div>
      
        <div class="row gy-4 mt-5 justify-content-center">
          <div class="col-6 col-md-3 col-xxl-2">
            <div class="hero__iconbox" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
              <a class="hero__iconboxLink scrollto active" href="#portfolio">
                <i class="hero__iconboxIcon">
                  <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon32"><path d="M12 8c-2.168 0-4 1.832-4 4s1.832 4 4 4 4-1.832 4-4-1.832-4-4-4zm0 6c-1.065 0-2-.935-2-2s.935-2 2-2 2 .935 2 2-.935 2-2 2z"></path><path d="M20 5h-2.586l-2.707-2.707A.996.996 0 0 0 14 2h-4a.996.996 0 0 0-.707.293L6.586 5H4c-1.103 0-2 .897-2 2v11c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V7c0-1.103-.897-2-2-2zM4 18V7h3c.266 0 .52-.105.707-.293L10.414 4h3.172l2.707 2.707A.996.996 0 0 0 17 7h3l.002 11H4z"></path></svg>
                </i>
                <h3 class="hero__iconboxText" itemprop="name">Sesje zdjęciowe</h3>
              </a>
            </div>
          </div>
          <div class="col-6 col-md-3 col-xxl-2">
            <div class="hero__iconbox" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
              <a class="hero__iconboxLink scrollto active" href="#portfolio">
                <i class="hero__iconboxIcon">
                  <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon32"><path d="M13.707 2.293a.999.999 0 0 0-1.414 0l-5.84 5.84c-.015-.001-.029-.009-.044-.009a.997.997 0 0 0-.707.293L4.288 9.831a2.985 2.985 0 0 0-.878 2.122c0 .802.313 1.556.879 2.121l.707.707-2.122 2.122A2.92 2.92 0 0 0 2 19.012a2.968 2.968 0 0 0 1.063 2.308c.519.439 1.188.68 1.885.68.834 0 1.654-.341 2.25-.937l2.04-2.039.707.706c1.134 1.133 3.109 1.134 4.242.001l1.415-1.414a.997.997 0 0 0 .293-.707c0-.026-.013-.05-.015-.076l5.827-5.827a.999.999 0 0 0 0-1.414l-8-8zm-.935 16.024a1.023 1.023 0 0 1-1.414-.001l-1.414-1.413a.999.999 0 0 0-1.414 0l-2.746 2.745a1.19 1.19 0 0 1-.836.352.91.91 0 0 1-.594-.208A.978.978 0 0 1 4 19.01a.959.959 0 0 1 .287-.692l2.829-2.829a.999.999 0 0 0 0-1.414L5.701 12.66a.99.99 0 0 1-.292-.706c0-.268.104-.519.293-.708l.707-.707 7.071 7.072-.708.706zm1.889-2.392L8.075 9.339 13 4.414 19.586 11l-4.925 4.925z"></path></svg>
                </i>
                <h3 class="hero__iconboxText" itemprop="name">Edycja zdjęć</h3>
              </a>
            </div>
          </div>
          <div class="col-6 col-md-3 col-xxl-2">
            <div class="hero__iconbox" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
              <a class="hero__iconboxLink scrollto active" href="#portfolio">
                <i class="hero__iconboxIcon">
                  <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon32"><path d="M22 8a.76.76 0 0 0 0-.21v-.08a.77.77 0 0 0-.07-.16.35.35 0 0 0-.05-.08l-.1-.13-.08-.06-.12-.09-9-5a1 1 0 0 0-1 0l-9 5-.09.07-.11.08a.41.41 0 0 0-.07.11.39.39 0 0 0-.08.1.59.59 0 0 0-.06.14.3.3 0 0 0 0 .1A.76.76 0 0 0 2 8v8a1 1 0 0 0 .52.87l9 5a.75.75 0 0 0 .13.06h.1a1.06 1.06 0 0 0 .5 0h.1l.14-.06 9-5A1 1 0 0 0 22 16V8zm-10 3.87L5.06 8l2.76-1.52 6.83 3.9zm0-7.72L18.94 8 16.7 9.25 9.87 5.34zM4 9.7l7 3.92v5.68l-7-3.89zm9 9.6v-5.68l3-1.68V15l2-1v-3.18l2-1.11v5.7z"></path></svg>
                </i>
                <h3 class="hero__iconboxText" itemprop="name">Wizualizacje 3D</h3>
              </a>
            </div>
          </div>
          <div class="col-6 col-md-3 col-xxl-2">
            <div class="hero__iconbox" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
              <a class="hero__iconboxLink scrollto active" href="#portfolio">
                <i class="hero__iconboxIcon">
                  <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon32"><path d="M18 7c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-3.333L22 17V7l-4 3.333V7zm-1.998 10H4V7h12l.001 4.999L16 12l.001.001.001 4.999z"></path></svg>
                </i>
                <h3 class="hero__iconboxText">Animacje</h3>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Koniec sekcji Hero -->

    <main id="main">

      <!-- ======= Sekcja O nas ======= -->
      <section id="about" class="about track-section" itemscope itemtype="https://schema.org/Organization">
        <div class="container" data-aos="fade-up">
          <div class="row">
            <div class="section-title">
              <h2 itemprop="name">O nas</h2>
              <p>Specjaliści grafiki produktowej</p>
            </div>
            <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
              <img src="assets/img/studio_fotograficzne.webp" width="700" height="598" class="img-fluid" alt="Biuro studia. W tle plan, na pierwszym planie stół z komputerem." loading="lazy" />
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
              <p itemprop="description">Witaj w naszym studio fotograficznym! Jesteśmy grupą pasjonatów specjalizujących się w fotografii produktowej, reklamowej oraz grafice 3D. W naszym studio w Poznaniu realizujemy profesjonalne sesje produktowe i sesje zdjęciowe dla e-commerce. Dzięki doświadczeniu w packshotach, edycji i retuszu zdjęć, uchwycimy esencję Twojego produktu, prezentując go w najlepszym świetle.
              
                Korzystamy z najnowocześniejszych technologii, w tym wizualizacji i animacji 3D oraz foto 360, tworząc przepiękne zdjęcia produktów i wyjątkowe wizualizacje, również dla home stagingu i virtual home stagingu. Każde zdjęcie produktowe jest dopracowane dzięki zaawansowanej obróbce, wycinaniu tła oraz precyzyjnej edycji. Oferujemy także fotografię wnętrz.
              
                W naszym studio tworzymy nie tylko zdjęcia packshotowe, ale też grafiki 3D i projekty graficzne. Współpracujemy z agencjami reklamowymi, oferując najlepsze rozwiązania marketingowe. Nasze profesjonalne sesje i fotografia produktowa gwarantują, że zdjęcia do sklepu internetowego będą wyglądały profesjonalnie i przyciągały oko klientów.
              
                Studio w Poznaniu oferuje kompleksowe usługi fotograficzne, w tym fotografię AGD, przedmiotów i zdjęcia na białym tle. Jesteśmy dumni z naszych zdjęć, które doskonale sprawdzają się na platformach e-commerce, takich jak Allegro.
              
                Zapraszamy do naszego studia, gdzie nasz zespół utalentowanych fotografów i grafików stworzy unikalne zdjęcia i wizualizacje. Niezależnie od potrzeb – zdjęcia produktowe, sesje dla marki czy animacje 3D – jesteśmy gotowi sprostać Twoim oczekiwaniom. Dołącz do naszych zadowolonych klientów i doświadcz magii fotografii produktowej oraz grafiki 3D w najlepszym wydaniu.
              
                Witaj w świecie kreatywności i inspiracji, gdzie każde zdjęcie jest dziełem sztuki.</p>
            </div>
          </div>
        </div>
      </section>
      <!-- Koniec sekcji O nas -->

      <!-- ======= Sekcja Funkcje ======= -->
      <section id="features" class="features track-section">
        <div class="container" data-aos="fade-up">
          <div class="row">
            <div class="image col-lg-6" data-aos="fade-right">
              <img src="assets/img/komputer_praca.webp" width="900" height="600" class="img-fluid h-100 object-fit-cover" alt="Widok przedstawiający pracę przy komputerze. Widoczne ręce, myszka i klawiatura" loading="lazy" />
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
              <div class="d-flex flex-column justify-content-end h-100">
                <div class="icon-box mt-5 w-100" data-aos="zoom-in" data-aos-delay="150">
                  <i>
                    <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon32"><path d="M9 20h6v2H9zm7.906-6.288C17.936 12.506 19 11.259 19 9c0-3.859-3.141-7-7-7S5 5.141 5 9c0 2.285 1.067 3.528 2.101 4.73.358.418.729.851 1.084 1.349.144.206.38.996.591 1.921H8v2h8v-2h-.774c.213-.927.45-1.719.593-1.925.352-.503.726-.94 1.087-1.363zm-2.724.213c-.434.617-.796 2.075-1.006 3.075h-2.351c-.209-1.002-.572-2.463-1.011-3.08a20.502 20.502 0 0 0-1.196-1.492C7.644 11.294 7 10.544 7 9c0-2.757 2.243-5 5-5s5 2.243 5 5c0 1.521-.643 2.274-1.615 3.413-.373.438-.796.933-1.203 1.512z"></path></svg>
                  </i>
                  <h4 itemprop="name">Wspólna wizja</h4>
                  <p itemprop="description">Wierzymy w moc współpracy, która jest kluczem do udanych sesji zdjęciowych i projektów graficznych. Ścisła współpraca z naszymi klientami pozwala nam zrozumieć ich unikalne wizje i cele. Jesteśmy aktywnie zaangażowani w proces twórczy, aby efekt końcowy oddawał Twoje wyobrażenia, a nawet przewyższał oczekiwania. Każda sesja zdjęciowa poznań oraz każdy projekt, czy to packshot 360, czy zdjęcia produktowe do e-commerce, jest realizowany z myślą o pełnym zadowoleniu klienta.</p>
                </div>
                <div class="icon-box mt-5 w-100" data-aos="zoom-in" data-aos-delay="150">
                  <i>
                    <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon32"><circle cx="12" cy="12" r="3"></circle><path d="M13 4.069V2h-2v2.069A8.008 8.008 0 0 0 4.069 11H2v2h2.069A8.007 8.007 0 0 0 11 19.931V22h2v-2.069A8.007 8.007 0 0 0 19.931 13H22v-2h-2.069A8.008 8.008 0 0 0 13 4.069zM12 18c-3.309 0-6-2.691-6-6s2.691-6 6-6 6 2.691 6 6-2.691 6-6 6z"></path></svg>
                  </i>
                  <h4 itemprop="name">Spersonalizowane podejście</h4>
                  <p itemprop="description">Traktujemy każdego klienta jako cennego partnera. Nasz zespół poświęca czas na słuchanie Twoich indywidualnych potrzeb, preferencji i celów. Dzięki temu możemy dostosować nasze usługi do Twoich wymagań, zapewniając spersonalizowane doświadczenie, które odzwierciedla Twój styl i markę. Niezależnie od tego, czy chodzi o fotografię wnętrz, virtual staging, zdjęcia produktów do sklepu internetowego czy sesje dla e-commerce, nasze podejście jest zawsze indywidualne.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-12" data-aos="fade-left" data-aos-delay="100">
              <div class="row">
                <div class="col-lg-6">
                  <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">
                    <i>
                      <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon32"><path d="M20 2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h3v3.766L13.277 18H20c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zm0 14h-7.277L9 18.234V16H4V4h16v12z"></path><circle cx="15" cy="10" r="2"></circle><circle cx="9" cy="10" r="2"></circle></svg>
                    </i>
                    <h4 itemprop="name">Skuteczna komunikacja</h4>
                    <p itemprop="description">Komunikacja jest kluczem do udanej współpracy. Utrzymujemy otwarte kanały komunikacji przez cały proces, konsultując kolejne etapy współpracy. Nasz zespół jest zaangażowany i dba o to, aby Twoje opinie i pomysły zostały uwzględnione w ostatecznej wersji projektu. Czy to podczas retuszu zdjęć, edycji zdjęcia, czy wycinania tła ze zdjęcia, zawsze jesteśmy dostępni, aby omówić szczegóły i zapewnić, że końcowy efekt spełnia Twoje oczekiwania.</p>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">
                    <i>
                      <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon32"><path d="m6.516 14.323-1.49 6.452a.998.998 0 0 0 1.529 1.057L12 18.202l5.445 3.63a1.001 1.001 0 0 0 1.517-1.106l-1.829-6.4 4.536-4.082a1 1 0 0 0-.59-1.74l-5.701-.454-2.467-5.461a.998.998 0 0 0-1.822 0L8.622 8.05l-5.701.453a1 1 0 0 0-.619 1.713l4.214 4.107zm2.853-4.326a.998.998 0 0 0 .832-.586L12 5.43l1.799 3.981a.998.998 0 0 0 .832.586l3.972.315-3.271 2.944c-.284.256-.397.65-.293 1.018l1.253 4.385-3.736-2.491a.995.995 0 0 0-1.109 0l-3.904 2.603 1.05-4.546a1 1 0 0 0-.276-.94l-3.038-2.962 4.09-.326z"></path></svg>
                    </i>
                    <h4 itemprop="name">Zadowolenie klienta</h4>
                    <p itemprop="description">Naszym ostatecznym celem jest Twoje zadowolenie. Dokładamy wszelkich starań, abyś był zachwycony rezultatami. Dążymy do doskonałości pod każdym względem, począwszy od jakości naszej fotografii produktowej i grafiki 3D, aż po poziom obsługi. Twój sukces to nasz sukces. Z dumą dostarczamy wyjątkowe dzieła, które pozostają na dłużej w pamięci. Niezależnie od tego, czy potrzebujesz zdjęć na białym tle, zdjęć allegro, fotografii AGD, czy zdjęć do swojego sklepu internetowego, jesteśmy tutaj, aby sprostać Twoim wymaganiom.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Koniec sekcji Funkcje -->

      <!-- ======= Sekcja Portfolio ======= -->
      <section id="portfolio" class="portfolio track-section">
        <div class="container" data-aos="fade-up">
          <div class="section-title">
            <h2>Portfolio</h2>
            <p>Sprawdź nasze portfolio</p>
          </div>

          <!-- ======= Portfolio slider======= -->

          <div class="centerr">
            <h3>Aranżacje</h3>
          </div>

          <section id="portfolio-slider-arranges" class="portfolio">
            <div data-aos="zoom-in" id="arranges">
              <div class="portfolio-slider portfolio-slider-arranges swiper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/aranz/aranz_kuchnia.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/aranz/aranz_kuchnia.webp" class="img-fluid" alt="płyta indukcyjna w aranżu kuchennym" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/aranz/aranz_kuchnia_2.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/aranz/aranz_kuchnia_2.webp" class="img-fluid" alt="Płyta indukcyjna w aranżu kuchennym" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/aranz/aranz_kuchnia_3.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/aranz/aranz_kuchnia_3.webp" class="img-fluid" alt="Okap i płyta gazowa w aranżu kuchennym" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/aranz/aranz_kawa.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/aranz/aranz_kawa.webp" class="img-fluid" alt="Filiżanka z kawą i dzbanek z mlekiem. Dookoła rozsypane ziarna kawy" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/aranz/aranz_perfum.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/aranz/aranz_perfum.webp" class="img-fluid" alt="Perfum w aranżu pola lawendy między rzędami" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/aranz/aranz_pralka.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/aranz/aranz_pralka.webp" class="img-fluid" alt="Pralka w aranżu łazienkowym. Widok z okna na ogród." loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/aranz/aranz_drink.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/aranz/aranz_drink.webp" class="img-fluid" alt="Szklanka z drinkiem, cytryną i słomką. Plusk slowmotion." loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/aranz/aranz_papryka.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/aranz/aranz_papryka.webp" class="img-fluid" alt="Papryki z plaśnięciem wody" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="swiper-pagination"></div>
              </div>
            </div>
          </section>
        </div>

        <div class="container" data-aos="fade-up">
          <div class="centerr">
            <h3>Produkty</h3>
          </div>

          <section id="portfolio-slider-products" class="portfolio">
            <div data-aos="zoom-in" id="products">
              <div class="portfolio-slider portfolio-slider-products swiper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/sote/fotografia_produktowa_kawa.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/sote/fotografia_produktowa_kawa.webp" class="img-fluid" alt="Filiżanka z rozsypanymi ziarnami kawy" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/sote/fotografia_produktowa_kuchenka.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/sote/fotografia_produktowa_kuchenka.webp" class="img-fluid" alt="Otwarty piekarnik" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/sote/fotografia_produktowa_perfum.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/sote/fotografia_produktowa_perfum.webp" class="img-fluid" alt="Perfum w połowie zaciemniony" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/sote/fotografia_produktowa_piekarnik.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/sote/fotografia_produktowa_piekarnik.webp" class="img-fluid" alt="Zamknięty czarny piekarnik od frontu" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/sote/fotografia_produktowa_zegarek.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/sote/fotografia_produktowa_zegarek.webp" class="img-fluid" alt="Zegarek stojący pionowo" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/sote/packshot_kawa.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/sote/packshot_kawa.webp" class="img-fluid" alt="Kawa latte w przeźroczystym kubku" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/sote/packshot_okap.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/sote/packshot_okap.webp" class="img-fluid" alt="Czarny okap z trzech szyb" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/sote/packshot_slowmotion_filizanka_kawa.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/sote/packshot_slowmotion_filizanka_kawa.webp" class="img-fluid" alt="Filiżanka kawy z wpadającą kostką cukru" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/sote/packshot_stolik.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/sote/packshot_stolik.webp" class="img-fluid" alt="Biały stolik" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/sote/packshot_ferrari.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/sote/packshot_ferrari.webp" class="img-fluid" alt="Model samochodu ferrari" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="swiper-pagination"></div>
              </div>
            </div>
          </section>
        </div>

        <div class="container" data-aos="fade-up">
          <div class="centerr">
            <h3>home stage</h3>
          </div>

          <section id="portfolio-slider-homestages" class="portfolio">
            <div data-aos="zoom-in" id="homestages">
              <div class="portfolio-slider portfolio-slider-homestages swiper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/homestage/homestage_salon.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/homestage/homestage_salon.webp" class="img-fluid" alt="Salon z kanapą stolikiem i kwiatem" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/homestage/homestage_salon_2.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/homestage/homestage_salon_2.webp" class="img-fluid" alt="Salon z fotelem, lampą i półką na książki." loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/homestage/homestage_kuchnia.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/homestage/homestage_kuchnia.webp" class="img-fluid" alt="Kuchnia z zabudową kuchenną i nowoczesnym kaloryferem" loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/homestage/homestage_kuchnia_2.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/homestage/homestage_kuchnia_2.webp" class="img-fluid" alt="Kuchnia z zabudową kuchenną i stolikiem z rogalikiem i kawą." loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="portfolio-wrap">
                      <a href="assets/img/portfolio/homestage/homestage_sypialnia.webp" data-gallery="portfolioGallery" class="portfolio-lightbox">
                        <img src="assets/img/portfolio/homestage/homestage_sypialnia.webp" class="img-fluid" alt="Sypialnia z łóżkiem z pościelą i poduszkami." loading="lazy" />
                        <div class="portfolio-info"></div>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="swiper-pagination"></div>
              </div>
            </div>
          </section>
        </div>

        <div class="container" data-aos="fade-up">
          <div class="centerr">
            <h3>Przed i po</h3>
          </div>

          <div class="parent-container">
            <div class="image-container" id="imageContainer">
              <img src="assets/img/portfolio/przedpo/obrobka_editing_zegarek_po.webp" class="before-image" alt="Zdjęcie zegarka po obróbce." loading="lazy" />
              <img src="assets/img/portfolio/przedpo/obrobka_editing_zegarek_przed.webp" class="after-image" alt="Zdjęcie zegarka przed obróbką." loading="lazy" />
            </div>
          </div>
        </div>
      </section>
      <!-- Koniec sekcji Portfolio -->

      <!-- ======= Sekcja cennik ======= -->
      <section id="services" class="services track-section">
        <div class="container" data-aos="fade-up">
          <div class="section-title">
            <h2>Fotografia produktowa cennik</h2>
            <p>Zapoznaj się z cennikiem</p>
          </div>

          <div class="row">
            <div class="col-sm-6 col-lg-3 mt-4 mt-md-4" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon-box h-100">
                <div class="icon">
                  <i>
                    <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon32"><path d="M12 9c-1.626 0-3 1.374-3 3s1.374 3 3 3 3-1.374 3-3-1.374-3-3-3z"></path><path d="M20 5h-2.586l-2.707-2.707A.996.996 0 0 0 14 2h-4a.996.996 0 0 0-.707.293L6.586 5H4c-1.103 0-2 .897-2 2v11c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V7c0-1.103-.897-2-2-2zm-8 12c-2.71 0-5-2.29-5-5s2.29-5 5-5 5 2.29 5 5-2.29 5-5 5z"></path></svg>
                  </i>
                </div>
                <h4>Edycja zdjęć</h4>
                <p>Packshot - od 35zł</p>
                <p>Typu "duch" - od 45zł</p>
                <p>Aranż - od 50zł</p>
                <p>360° - od 50zł</p>
                <p>Home staging - od 200zł</p>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3 mt-4 mt-md-4" data-aos="zoom-in" data-aos-delay="200">
              <div class="icon-box h-100">
                <div class="icon">
                  <i>
                    <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon32"><path d="m21.207 11.278-2.035-2.035-1.415-1.415-5.035-5.035a.999.999 0 0 0-1.414 0L6.151 7.949 4.736 9.363a2.985 2.985 0 0 0-.878 2.122c0 .802.313 1.556.879 2.121l.707.707-2.122 2.122a2.925 2.925 0 0 0-.873 2.108 2.968 2.968 0 0 0 1.063 2.308 2.92 2.92 0 0 0 1.886.681c.834 0 1.654-.341 2.25-.937l2.039-2.039.707.706c1.133 1.133 3.107 1.134 4.242.001l.708-.707.569-.569.138-.138 5.156-5.157a.999.999 0 0 0 0-1.414zm-7.277 5.865-.708.706a1.021 1.021 0 0 1-1.414 0l-1.414-1.413a.999.999 0 0 0-1.414 0l-2.746 2.745a1.192 1.192 0 0 1-.836.352.914.914 0 0 1-.595-.208.981.981 0 0 1-.354-.782.955.955 0 0 1 .287-.692l2.829-2.829a.999.999 0 0 0 0-1.414l-1.414-1.415c-.189-.188-.293-.438-.293-.706s.104-.519.293-.708l.707-.707 3.536 3.536 3.536 3.535z"></path></svg>
                  </i>
                </div>
                <h4>Edycja zdjęć</h4>
                <p>100zł/1h pracy grafika</p>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3 mt-4 mt-lg-4" data-aos="zoom-in" data-aos-delay="300">
              <div class="icon-box h-100">
                <div class="icon">
                  <i>
                    <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon32"><path d="M21.993 7.95a.96.96 0 0 0-.029-.214c-.007-.025-.021-.049-.03-.074-.021-.057-.04-.113-.07-.165-.016-.027-.038-.049-.057-.075-.032-.045-.063-.091-.102-.13-.023-.022-.053-.04-.078-.061-.039-.032-.075-.067-.12-.094-.004-.003-.009-.003-.014-.006l-.008-.006-8.979-4.99a1.002 1.002 0 0 0-.97-.001l-9.021 4.99c-.003.003-.006.007-.011.01l-.01.004c-.035.02-.061.049-.094.073-.036.027-.074.051-.106.082-.03.031-.053.067-.079.102-.027.035-.057.066-.079.104-.026.043-.04.092-.059.139-.014.033-.032.064-.041.1a.975.975 0 0 0-.029.21c-.001.017-.007.032-.007.05V16c0 .363.197.698.515.874l8.978 4.987.001.001.002.001.02.011c.043.024.09.037.135.054.032.013.063.03.097.039a1.013 1.013 0 0 0 .506 0c.033-.009.064-.026.097-.039.045-.017.092-.029.135-.054l.02-.011.002-.001.001-.001 8.978-4.987c.316-.176.513-.511.513-.874V7.998c0-.017-.006-.031-.007-.048zm-10.021 3.922L5.058 8.005 7.82 6.477l6.834 3.905-2.682 1.49zm.048-7.719L18.941 8l-2.244 1.247-6.83-3.903 2.153-1.191zM13 19.301l.002-5.679L16 11.944V15l2-1v-3.175l2-1.119v5.705l-7 3.89z"></path></svg>
                  </i>
                </div>
                <h4>Wizualizacja 3D</h4>
                <p>od 200zł</p>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3 mt-4 mt-lg-4" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon-box h-100">
                <div class="icon">
                  <i>
                    <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon32"><path d="M18 7c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-3.333L22 17V7l-4 3.333V7z"></path></svg>
                  </i>
                </div>
                <h4>Animacje 3D</h4>
                <p>od 500 zł</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Koniec sekcji Usługi -->

      <!-- ======= Sekcja Usługi ======= -->
      <section id="services2" class="services track-section">
        <div class="container" data-aos="fade-up">
          <div class="section-title">
            <h2>Usługi</h2>
            <p>Usługi Fotograficzne i graficzne</p>
          </div>

          <div class="col-lg-12 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
            <p>Nasza agencja reklamowa oferuje szeroki zakres usług, aby wspierać Twoje działania marketingowe i sprzedażowe. Jako doświadczona firma reklamowa, zapewniamy, że każda sesja zdjęciowa w Poznaniu jest dopracowana do perfekcji. Niezależnie od tego, czy potrzebujesz packshotów 360, czy zdjęć produktów do sklepu internetowego, nasz fotograf w Poznaniu zadba o najdrobniejsze szczegóły.

              Dla klientów z branży e-commerce mamy specjalne oferty reklamowe, które pomagają wyróżnić się na tle konkurencji. W naszym studio zdjęciowym w Poznaniu możemy zrealizować każdą wizję, niezależnie od tego, czy jest to produktowe foto na białym tle, czy bardziej skomplikowana wizualizacja 3D.
              
              Nasze studio 3D jest wyposażone w najnowszy sprzęt, co pozwala nam na tworzenie niesamowitych efektów. Dodatkowo, oferujemy usługi takie jak obróbka zdjęć i korekta zdjęć, aby każde ujęcie było idealne. Zdajemy sobie sprawę, jak ważne są przepiękne zdjęcia dla sukcesu Twojej marki, dlatego do każdej sesji marki podchodzimy z pełnym zaangażowaniem.
              
              Nasza oferta obejmuje również home stage w Poznaniu, idealny dla tych, którzy chcą zwiększyć atrakcyjność swojego wnętrza przed sprzedażą. W naszym portfolio znajdziesz różnorodne sesje zdjęciowe i przykłady naszej pracy, które świadczą o naszym profesjonalizmie.
              
              Zapraszamy do współpracy wszystkich, którzy szukają niezawodnego partnera w dziedzinie fotografii i reklamy. Oferujemy kompleksowe usługi, które zadowolą nawet najbardziej wymagających klientów. Wybierz naszą agencję reklamową, aby skorzystać z najlepszych usług w zakresie fotografii produktowej, sesji zdjęciowych i innych.</p>
          </div>
        </div>
      </section>
      <!-- Koniec sekcji Usługi -->

      <!-- ======= Sekcja Zespół ======= -->
      <section id="team" class="team track-section">
        <div class="container" data-aos="fade-up">
          <div class="section-title">
            <h2>Zespół</h2>
            <p>Zespół kreatywnych profesjonalistów</p>
          </div>
          <div class="row">
            <div class="col-6 col-lg-3 d-flex align-items-stretch">
              <div class="member" data-aos="fade-up" data-aos-delay="100">
                <div class="member-img">
                  <img src="assets/img/team/mezczyzna_garnitur_kawa.webp" width="472" height="632" class="img-fluid w-100" alt="Mężczyzna w garniturze z kawą." loading="lazy" />
                  <div class="social">
                    <!-- media
                  <a href=""><i class="bx bxl-twitter"></i></a>
                  <a href=""><i class="bx bxl-facebook-circle"></i></a>
                  <a href=""><i class="bx bxl-instagram-alt"></i></a>
                  <a href=""><i class="bx bxl-linkedin"></i></a>
                  --></div>
                </div>
                <div class="member-info">
                  <h4>Stanisław Rogala</h4>
                  <span>Grafik 2D i 3D, automatyk procesów</span>
                </div>
              </div>
            </div>

            <div class="col-6 col-lg-3 d-flex align-items-stretch">
              <div class="member" data-aos="fade-up" data-aos-delay="200">
                <div class="member-img">
                  <img src="assets/img/team/mezczyzna_garnitur_grafik.webp" width="1000" height="1339" class="img-fluid w-100" alt="Mężczyzna granatowym garniturze." loading="lazy" />
                  <div class="social">
                    <!-- media
                  <a href=""><i class="bx bxl-twitter"></i></a>
                  <a href=""><i class="bx bxl-facebook-circle"></i></a>
                  <a href=""><i class="bx bxl-instagram-alt"></i></a>
                  <a href=""><i class="bx bxl-linkedin"></i></a>
                  --></div>
                </div>
                <div class="member-info">
                  <h4>Bartosz Włodarkiewicz</h4>
                  <span>Fotograf, grafik 2D</span>
                </div>
              </div>
            </div>

            <div class="col-6 col-lg-3 d-flex align-items-stretch">
              <div class="member" data-aos="fade-up" data-aos-delay="300">
                <div class="member-img">
                  <img src="assets/img/team/mezczyzna_fotograf.webp" width="472" height="632" class="img-fluid w-100" alt="Mężczyzna w garniturze z muszką." loading="lazy" />
                  <div class="social">
                    <!-- media
                  <a href=""><i class="bx bxl-twitter"></i></a>
                  <a href=""><i class="bx bxl-facebook-circle"></i></a>
                  <a href=""><i class="bx bxl-instagram-alt"></i></a>
                  <a href=""><i class="bx bxl-linkedin"></i></a>
                  --></div>
                </div>
                <div class="member-info">
                  <h4>Krzysztof Kaczmarek</h4>
                  <span>Fotograf</span>
                </div>
              </div>
            </div>

            <div class="col-6 col-lg-3 d-flex align-items-stretch">
              <div class="member" data-aos="fade-up" data-aos-delay="400">
                <div class="member-img">
                  <img src="assets/img/team/kobieta_grafik.webp" width="472" height="632" class="img-fluid w-100" alt="Kobieta blondynka w granatowej bluzce." loading="lazy" />
                  <div class="social">
                    <!-- media
                  <a href=""><i class="bx bxl-twitter"></i></a>
                  <a href=""><i class="bx bxl-facebook-circle"></i></a>
                  <a href=""><i class="bx bxl-instagram-alt"></i></a>
                  <a href=""><i class="bx bxl-linkedin"></i></a>
                  --></div>
                </div>
                <div class="member-info">
                  <h4>Anna Zielińska</h4>
                  <span>Grafik 2D</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Koniec sekcji Zespół -->

      <!-- ======= Counts Section ======= -->
      <section id="counts" class="counts track-section">
        <div class="container" data-aos="fade-up">
          <div class="row">
            <div class="section-title">
              <h2>Doświadczenie</h2>
            </div>
            <div class="image col-xl-5" data-aos="fade-right" data-aos-delay="100">
              <div class="image ratio ratio-16x9">
                <img src="assets/img/konsultacje.webp" class="img-fluid object-fit-cover" alt="Ludzie rozmawiają ze sobą patrząc w ekran komputera." loading="lazy" />
              </div>
            </div>
            <div class="col-xl-7 d-flex align-items-stretch" data-aos="fade-left" data-aos-delay="100">
              <div class="content d-flex flex-column justify-content-center pt-4 pt-xl-0">
                <h3 class="text-xl-center text-uppercase">Doświadczenie w liczbach:</h3>
                <div class="row">
                  <div class="col-md-6 col-lg-4 d-md-flex align-items-md-stretch">
                    <div class="count-box">
                      <i>
                        <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon32"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M14.829 14.828a4.055 4.055 0 0 1-1.272.858 4.002 4.002 0 0 1-4.875-1.45l-1.658 1.119a6.063 6.063 0 0 0 1.621 1.62 5.963 5.963 0 0 0 2.148.903 6.042 6.042 0 0 0 2.415 0 5.972 5.972 0 0 0 2.148-.903c.313-.212.612-.458.886-.731.272-.271.52-.571.734-.889l-1.658-1.119a4.017 4.017 0 0 1-.489.592z"></path><circle cx="8.5" cy="10.5" r="1.5"></circle><circle cx="15.493" cy="10.493" r="1.493"></circle></svg>
                      </i>
                      <span data-purecounter-start="0" data-purecounter-end="65" data-purecounter-duration="2" class="purecounter"></span>
                      <p>
                        <strong>Zadowolonych klientów</strong> skorzystało z naszych <strong>usług</strong> i mogą zaświadczyć o naszym zaangażowaniu podczas realizacji <strong>zamówień</strong>.
                      </p>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-4 d-md-flex align-items-md-stretch">
                    <div class="count-box">
                      <i>
                        <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon32"><path d="M19 4h-3V2h-2v2h-4V2H8v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zM5 20V7h14V6l.002 14H5z"></path><path d="M7 9h10v2H7zm0 4h5v2H7z"></path></svg>
                      </i>
                      <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="2" class="purecounter"></span>
                      <p>
                        <strong>Projektów</strong> pozostawiło ślad, prezentując naszą wiedzę w dziedzinie <strong>grafiki produktowej</strong> i poświęcenie w osiąganiu niezwykłych <strong>rezultatów</strong> .
                      </p>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-4 d-md-flex align-items-md-stretch">
                    <div class="count-box">
                      <i>
                        <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon32"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M13 7h-2v5.414l3.293 3.293 1.414-1.414L13 11.586z"></path></svg>
                      </i>
                      <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="2" class="purecounter"></span>
                      <p>
                        <strong>Lat doświadczenia</strong> , podczas których nasza firma rosła i kwitła, ugruntowując solidną reputację dostarczania wysokiej jakości <strong>usług fotograficznych i 3D</strong>.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End .content-->
            </div>
          </div>
        </div>
      </section>
      <!-- End Counts Section -->

      <!-- ======= Contact Section ======= -->
      <section id="contact" class="contact track-section">
        <div class="container" data-aos="fade-up">
          <div class="row">
            <div class="section-title">
              <h2>Kontakt</h2>
              <p>Napisz lub zadzwoń</p>
            </div>
            <div id="map"></div>          
            </div>

            <div class="row mt-5">
              <div class="col-lg-4">
                <address class="info">
                  <div class="address">
                    <h3 class="fs-1">
                      <i class="me-2">
                        <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon"><path d="M12 14c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.103 0 2 .897 2 2s-.897 2-2 2-2-.897-2-2 .897-2 2-2z"></path><path d="M11.42 21.814a.998.998 0 0 0 1.16 0C12.884 21.599 20.029 16.44 20 10c0-4.411-3.589-8-8-8S4 5.589 4 9.995c-.029 6.445 7.116 11.604 7.42 11.819zM12 4c3.309 0 6 2.691 6 6.005.021 4.438-4.388 8.423-6 9.73-1.611-1.308-6.021-5.294-6-9.735 0-3.309 2.691-6 6-6z"></path></svg>
                      </i>
                      Lokalizacja:
                    </h3>
                    <h2>Poznań 60-574, <br> Dąbrowskiego 89/183</h2>
                  </div>

                  <div class="email">
                    <h3 class="fs-1">
                      <i class="me-2">
                        <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon"><path d="M20 4H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm0 2v.511l-8 6.223-8-6.222V6h16zM4 18V9.044l7.386 5.745a.994.994 0 0 0 1.228 0L20 9.044 20.002 18H4z"></path></svg>
                      </i>
                      Email:
                    </h3>
                    <h2>
                      <a href="mailto:office@pixelum.pl" class="h3">
                        office@pixelum.pl
                      </a>
                    </h2>
                  </div>

                  <div class="phone">
                    <h3 class="fs-1">
                      <i class="me-2">
                        <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon">
                          <path d="M16.57 22a2 2 0 0 0 1.43-.59l2.71-2.71a1 1 0 0 0 0-1.41l-4-4a1 1 0 0 0-1.41 0l-1.6 1.59a7.55 7.55 0 0 1-3-1.59 7.62 7.62 0 0 1-1.59-3l1.59-1.6a1 1 0 0 0 0-1.41l-4-4a1 1 0 0 0-1.41 0L2.59 6A2 2 0 0 0 2 7.43 15.28 15.28 0 0 0 6.3 17.7 15.28 15.28 0 0 0 16.57 22zM6 5.41 8.59 8 7.3 9.29a1 1 0 0 0-.3.91 10.12 10.12 0 0 0 2.3 4.5 10.08 10.08 0 0 0 4.5 2.3 1 1 0 0 0 .91-.27L16 15.41 18.59 18l-2 2a13.28 13.28 0 0 1-8.87-3.71A13.28 13.28 0 0 1 4 7.41zM20 11h2a8.81 8.81 0 0 0-9-9v2a6.77 6.77 0 0 1 7 7z"></path><path d="M13 8c2.1 0 3 .9 3 3h2c0-3.22-1.78-5-5-5z"></path>
                        </svg>
                      </i>
                      Zadzwoń:
                    </h3>
                    <h2>
                      <a href="tel:+48604216600" class="h3">
                        +48 604216600
                      </a>
                    </h2>
                    <!-- 
                    <h2>
                      <a href="tel:+48608732459" class="h3">
                        +48 608732459
                      </a>
                    </h2>
                     -->
                  </div>
                </address>
              </div>

              <div class="col-lg-8 mt-5 mt-lg-0">
                <form id="contactform" action="forms/contact.php" method="post" role="form" class="d-block php-email-form">
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input type="text" name="name" class="form-control" id="name" placeholder="Twoje imię" autocomplete="true"/>
                    </div>
                    <div class="col-md-6 form-group mt-3 mt-md-0">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Twój Email" autocomplete="true"/>
                    </div>
                  </div>
                  <div class="form-group mt-3">
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Temat" autocomplete="true"/>
                  </div>
                  <div class="form-group mt-3">
                    <textarea class="form-control" name="message" rows="5" placeholder="Wiadomość"></textarea>
                  </div>
                  <div class="my-3">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Twoja wiadomość została wysłana. Dziękujemy!</div>
                  </div>
                  <div class="text-center">
                    <button type="submit">Wyślij wiadomość</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Contact Section -->
    </main>
    <!-- End #main -->

    <!-- ======= Stopka ======= -->
    <footer id="footer">
      <div class="container">
        <h3>Pixelum</h3>
        <p>Z pasją do fotografii, grafiki 3D i projektowania graficznego tworzymy wyjątkowe i niezapomniane obrazy. Jesteśmy tu, aby Twoje pomysły stały się rzeczywistością.</p>
        <div class="social-links">
            <!--
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>        
          <a href="#" class="instagram"><i class="bx bxl-instagram-alt"></i></a>
          -->
          <a href="https://www.facebook.com/people/Pixelum/61558395214915/" class="facebook" aria-label="Odwiedź nas na Facebooku" target="_blank">
            <img src="/assets/img/facebook.webp" alt="Facebook" width="24" height="24" alt="Facebook icon">
          </a>
          <a href="https://www.linkedin.com/company/pixelum-studio" class="linkedin" aria-label="Odwiedź nas na Linkedin" target="_blank">
            <img src="/assets/img/linkedin.webp" alt="LinkedIn" width="24" height="24" alt="Linkedinicon">
          </a>
        </div>
      </div>
      
    </footer>
    <!-- End #footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
      <i>
        <svg xmlns="https://www.w3.org/2000/svg"  viewBox="0 0 24 24" class="icon"><path d="M11 8.414V18h2V8.414l4.293 4.293 1.414-1.414L12 4.586l-6.707 6.707 1.414 1.414z"></path></svg>
      </i>
    </a>

    <!-- inject:js -->
    <!-- endinject:js -->
    <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  </body>
</html>
