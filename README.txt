SHARPSIDE — Custom WordPress Theme (v1.0.0)
============================================

A lean, SEO-first theme for sharpsidebet.com. No page builder, no jQuery.

------------------------------------------------------------
INSTALL (2 minutes)
------------------------------------------------------------
1. Zip this folder so the archive contains a top-level "sharpside/" folder
   (already done if you received sharpside-theme.zip).
2. WordPress Admin → Appearance → Themes → Add New → Upload Theme.
3. Choose sharpside-theme.zip → Install Now → Activate.

------------------------------------------------------------
FIRST-RUN SETUP
------------------------------------------------------------
1. PERMALINKS: Settings → Permalinks → choose "Post name" (SEO-friendly URLs).
2. LOGO: Appearance → Customize → Site Identity → upload your logo
   (falls back to the diamond mark + site name if none).
3. PAGES: create these Pages (Pages → Add New), then set their slugs:
      - Subscriptions   → in Page Attributes, set Template = "Subscriptions"
      - Track Record, Method, About, Contact, Free Play,
        Terms, Privacy, Responsible Gambling  (standard template)
4. BLOG: create a Page called "Blog". Then Settings → Reading →
      "Your homepage displays: A static page"
      Homepage = (leave as the theme's front page / a "Home" page)
      Posts page = "Blog".
   NOTE: front-page.php renders the designed homepage automatically.
5. MENUS: Appearance → Menus → create a menu, assign to "Primary Menu"
   (Track Record, Method, Subscriptions, Blog). A sensible fallback shows
   until you do.

------------------------------------------------------------
SEO (do this)
------------------------------------------------------------
1. Install "Rank Math SEO" (free). The theme detects it and steps aside on
   meta titles/descriptions, Open Graph, and Article schema to avoid
   duplicates. Rank Math also generates your XML sitemap.
   (Yoast works too — same auto-detection.)
2. The theme ALWAYS outputs Organization + WebSite JSON-LD (with your
   Instagram in sameAs). If you'd rather Rank Math own those too, you can
   remove the sharpside_json_ld hook — but running both is generally fine
   for Organization/WebSite.
3. Submit the sitemap in Google Search Console once live.
4. Featured images = your Open Graph share images. Add one to every post.

------------------------------------------------------------
LOGO
------------------------------------------------------------
The Sharpside lockup ships in the theme (assets/img/sharpside-logo.png,
white + volt for the dark header). It shows automatically. To swap it,
Appearance > Customize > Site Identity > upload a Logo; a custom logo
overrides the bundled one. Favicon: set Site Icon there too, otherwise the
bundled assets/img/favicon.png is used.

------------------------------------------------------------
LIVE TRACK RECORD (connect your tracker)
------------------------------------------------------------
The Track Record page shows sample data until you connect a sheet.
1) In your Google Sheet, make a flat "Log" tab with one row per play and a
   header row containing: Date, Matchup, Play, Odds, Close, CLV, Result,
   Stake, Units. (Result = Win/Loss/Push/No Bet.)
2) File > Share > Publish to web > choose that tab > Comma-separated (.csv)
   > Publish. Copy the link.
3) Appearance > Customize > "Sharpside: Track Record" > paste the CSV URL.
Stats, the log, and the monthly breakdown then render live (cached 10 min).
Leave the field blank to keep the sample data.

------------------------------------------------------------
WHOP CHECKOUT
------------------------------------------------------------
On the Subscriptions page, the tier buttons have data-whop attributes
(rundown / members / sharp). Point each button's href at your Whop
checkout URL for that plan. Same for the header "Join Sharpside" button.

------------------------------------------------------------
PERFORMANCE NOTES
------------------------------------------------------------
- JS is deferred; emoji + generator + wlwmanifest cruft removed.
- Fonts load from Google with preconnect. For best Core Web Vitals, later
  self-host the three fonts and swap the wp_enqueue_style('sharpside-fonts')
  URL in functions.php for a local stylesheet.
- Add a caching plugin (e.g. LiteSpeed Cache or WP Super Cache) once live.

------------------------------------------------------------
CUSTOMIZE
------------------------------------------------------------
- Colors/spacing: assets/css/main.css (CSS custom properties at the top —
  --volt is the accent, --black / --bone the grounds).
- Homepage sections + duotone hero: front-page.php.
- Hero photo: assets/img/hero-stadium.jpg (AI-generated, no real players/logos).
  Swap in your own high-contrast B&W image at the same path; the black->volt
  duotone is done in CSS (.hero__bg), so any grayscale photo works.
- Subscriptions page: page-subscriptions.php.
- Fonts: Anton (display) + Archivo (body) + JetBrains Mono (data).
- Build a child theme before editing if you want update-safe changes.

Files:
  style.css, functions.php, header.php, footer.php,
  front-page.php, page.php, page-subscriptions.php,
  single.php, archive.php, index.php, search.php, 404.php,
  assets/css/main.css, assets/js/main.js
