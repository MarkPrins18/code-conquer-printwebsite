 <!DOCTYPE html>
 <html lang="nl">

 <head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1" />
     <title>BOUW³D — Over ons</title>

     <!-- RELATIEVE PADEN -->
     <link rel="stylesheet" href="assets/css/global.css" />
     <link rel="stylesheet" href="assets/css/header-footer.css" />
     <link rel="stylesheet" href="assets/css/about-us.css">
     <script src="assets/js/header.js" defer></script>
     <script src="assets/js/about-us.js" defer></script>

 </head>

 <body>

     <?php include 'layout/header.html' ?>

     <main class="page">
         <!-- Linker contentkolom -->
         <section class="content">
             <h1>Over ons</h1>
             <p class="lead">
                 BOUW³D is de 3D-printspecialist voor de bouw in Breda en omgeving.
                 We versnellen projecten, verlagen kosten en beperken verspilling met
                 hoogwaardige, op maat geprinte onderdelen.
             </p>

             <div class="stats">
                 <article class="stat"><strong>5</strong><span>Jaar actief</span></article>
                 <article class="stat"><strong>420</strong><span>Projecten geleverd</span></article>
                 <article class="stat"><strong>4</strong><span>Dagen doorlooptijd (gem.)</span></article>
             </div>

             <div class="pill-grid">
                 <article class="pill">
                     <h3>Onze Missie & Innovatie</h3>
                     <p>Versnellen en verspilling verminderen met slimme 3D-printoplossingen.</p>
                 </article>
                 <article class="pill">
                     <h3>Onze Visie & Betrouwbaarheid</h3>
                     <p>De 3D-printpartner voor de bouw. Betrouwbaarheid staat voorop.</p>
                 </article>
                 <article class="pill">
                     <h3>Waarden & Duurzaamheid</h3>
                     <p>Efficiënt materiaalgebruik en lokaal produceren met continue innovatie.</p>
                 </article>
             </div>

             <!-- ======= HET TEAM (met eigen foto per kaart: upload / drag&drop) ======= -->
             <h2>Het team</h2>
             <ul class="team" id="teamList">
                 <li class="member-card" data-name="Leonel" data-role="Projectlead">
                     <div class="avatar-wrapper" data-dropzone>
                         <img class="avatar" alt="Foto Leonel"
                             src="C:\Users\stefa\source\repos\code-conquer-printwebsite-1\assets\images\index-images\3Dprinter-about-us.png">
                         <button class="upload-btn" type="button">Foto kiezen</button>
                         <input class="file-input" type="file" accept="image/*" aria-label="Upload foto Leonel">
                     </div>
                     <div class="id"><b>Leonel</b><small> Projectlead</small></div>
                 </li>

                 <li class="member-card" data-name="Sherwin" data-role="Operations">
                     <div class="avatar-wrapper" data-dropzone>
                         <img class="avatar" alt="Foto Sherwin" src="assets\images\index-images\3Dprinter-about-us.png">
                         <button class="upload-btn" type="button">Foto kiezen</button>
                         <input class="file-input" type="file" accept="image/*" aria-label="Upload foto Sherwin">
                     </div>
                     <div class="id"><b>Sherwin</b><small> Operations</small></div>
                 </li>

                 <!-- <li class="member-card" data-name="Stefan" data-role="Engineering">
          <div class="avatar-wrapper" data-dropzone>
            <img class="avatar" alt="Foto Stefan"
                 src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='180' height='220'><rect x='10' y='10' width='160' height='200' rx='22' fill='%23e9eef5'/><rect x='22' y='22' width='136' height='176' rx='18' fill='%23dbe3ee'/><circle cx='90' cy='90' r='30' fill='%23c7d2e3'/><rect x='50' y='135' width='80' height='40' rx='10' fill='%23cfd8e6'/></svg>">
            <button class="upload-btn" type="button">Foto kiezen</button>
            <input class="file-input" type="file" accept="image/*" aria-label="Upload foto Stefan">
          </div>
          <div class="id"><b>Stefan</b><small> Engineering</small></div>
        </li>

        <li class="member-card" data-name="Mark" data-role="Quality">
          <div class="avatar-wrapper" data-dropzone>
            <img class="avatar" alt="Foto Mark"
                 src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='180' height='220'><rect x='10' y='10' width='160' height='200' rx='22' fill='%23e9eef5'/><rect x='22' y='22' width='136' height='176' rx='18' fill='%23dbe3ee'/><circle cx='90' cy='90' r='30' fill='%23c7d2e3'/><rect x='50' y='135' width='80' height='40' rx='10' fill='%23cfd8e6'/></svg>">
            <button class="upload-btn" type="button">Foto kiezen</button>
            <input class="file-input" type="file" accept="image/*" aria-label="Upload foto Mark">
          </div>
          <div class="id"><b>Mark</b><small> Quality</small></div>
        </li>

        <li class="member-card" data-name="David" data-role="Logistiek">
          <div class="avatar-wrapper" data-dropzone>
            <img class="avatar" alt="Foto David"
                 src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='180' height='220'><rect x='10' y='10' width='160' height='200' rx='22' fill='%23e9eef5'/><rect x='22' y='22' width='136' height='176' rx='18' fill='%23dbe3ee'/><circle cx='90' cy='90' r='30' fill='%23c7d2e3'/><rect x='50' y='135' width='80' height='40' rx='10' fill='%23cfd8e6'/></svg>">
            <button class="upload-btn" type="button">Foto kiezen</button>
            <input class="file-input" type="file" accept="image/*" aria-label="Upload foto David">
          </div>
          <div class="id"><b>David</b><small> Logistiek</small></div>
        </li> -->
             </ul>
             <!-- ======= EINDE TEAM ======= -->

             <section class="cta">
                 <h3>Klaar voor maatwerk?</h3>
                 <p>Stuur je vraag en ontvang binnen 24 uur een voorstel.</p>
                 <button id="contactBtn" class="btn">Neem contact op</button>
             </section>

             <!-- We removed animation so this is not needed anymore -->

             <!-- <section class="controls" aria-label="Animatie-instellingen">
                 <button id="toggleAnim" class="btn btn-outline" aria-pressed="true">⏸︎ Pauzeer animatie</button>
                 <label for="speed" class="slider-label">Snelheid</label>
                 <input id="speed" type="range" min="0.5" max="2.0" step="0.1" value="1">
             </section> -->
         </section>

         <!-- Rechter ‘levende’ scene -->
         <figure class="scene" aria-label="3D-printer werkplaats">
             <img class="scene-bg" src="assets/images/index-images/3Dprinter-about-us.png"
                 alt="Industriële 3D-printer in werkplaats" />
         </figure>
     </main>

     <?php include 'layout/footer.html' ?>

     <!-- RELATIEVE PAD -->
 </body>

 </html>