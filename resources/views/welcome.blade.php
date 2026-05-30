<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'BD-ITEC') }} — Bangladesh IT Engineers Examination Center</title>

    <!-- Tailwind CSS v4 Browser CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0&display=swap"
        rel="stylesheet" />

    <style type="text/tailwindcss">
        @theme {
      --color-indigo-950: #1e1b4b;
      --font-display: 'Sora', sans-serif;
      --font-body:    'Plus Jakarta Sans', sans-serif;
    }
  </style>

    <style>
        /* ─── Base ─── */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            font-size: 16px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
            color: #0f172a;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Sora', sans-serif;
        }

        /* ─── Material Symbols ─── */
        .ms {
            font-family: 'Material Symbols Rounded';
            font-weight: normal;
            font-style: normal;
            display: inline-block;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            -webkit-font-smoothing: antialiased;
            vertical-align: middle;
        }

        /* ─── Scrollbar ─── */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #6366f1;
            border-radius: 3px;
        }

        /* ─── Gov Bar ─── */
        #govbar {
            background: #1e1b4b;
            border-bottom: 2px solid #6366f1;
            padding: 7px 0;
        }

        #govbar a {
            color: #a5b4fc;
            font-size: 11.5px;
            font-weight: 500;
            text-decoration: none;
            letter-spacing: .02em;
            transition: color .2s;
        }

        #govbar a:hover {
            color: #fff;
        }

        .flag-bd {
            width: 22px;
            height: 15px;
            border-radius: 2px;
            background: #006a4e;
            position: relative;
            display: inline-block;
            vertical-align: middle;
            overflow: hidden;
            flex-shrink: 0;
        }

        .flag-bd::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 45%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #f42a41;
        }

        /* ─── Navbar ─── */
        #navbar {
            background: rgba(255, 255, 255, .96);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 100;
            transition: all .3s;
        }

        #navbar.scrolled {
            background: rgba(15, 23, 42, .97);
            border-color: rgba(99, 102, 241, .25);
        }

        #navbar.scrolled .nav-link {
            color: #94a3b8;
        }

        #navbar.scrolled .nav-link:hover {
            color: #fff;
            background: rgba(99, 102, 241, .15);
        }

        #navbar.scrolled #logo-text {
            color: #fff;
        }

        #navbar.scrolled #logo-sub {
            color: #818cf8;
        }

        #navbar.scrolled #burger-icon {
            color: #e2e8f0;
        }

        .nav-link {
            font-size: 13.5px;
            font-weight: 500;
            color: #334155;
            padding: 7px 13px;
            border-radius: 8px;
            text-decoration: none;
            transition: all .2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .nav-link:hover {
            color: #4f46e5;
            background: #eef2ff;
        }

        .cta-btn {
            background: #4f46e5;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            padding: 9px 20px;
            border-radius: 10px;
            text-decoration: none;
            letter-spacing: .01em;
            transition: all .25s;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: inline-block;
        }

        .cta-btn:hover {
            background: #4338ca;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(79, 70, 229, .35);
        }

        /* ─── Ticker ─── */
        #ticker {
            background: #fffbeb;
            border-bottom: 1px solid #fde68a;
            padding: 9px 0;
            overflow: hidden;
        }

        .ticker-inner {
            display: inline-flex;
            white-space: nowrap;
            animation: ticker-scroll 40s linear infinite;
        }

        .ticker-inner:hover {
            animation-play-state: paused;
        }

        @keyframes ticker-scroll {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        .ticker-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0 48px;
            font-size: 12.5px;
            font-weight: 500;
            color: #92400e;
        }

        .ticker-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: #d97706;
            flex-shrink: 0;
        }

        /* ─── Hero ─── */
        #hero {
            background: #0f172a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        #hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 15% 55%, rgba(79, 70, 229, .28) 0%, transparent 60%),
                radial-gradient(ellipse 50% 50% at 85% 20%, rgba(14, 165, 233, .2) 0%, transparent 55%),
                radial-gradient(ellipse 60% 40% at 50% 100%, rgba(99, 102, 241, .12) 0%, transparent 60%);
            pointer-events: none;
        }

        .hero-grid-bg {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(99, 102, 241, .06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99, 102, 241, .06) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(99, 102, 241, .15);
            border: 1px solid rgba(99, 102, 241, .3);
            color: #a5b4fc;
            font-size: 11.5px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 99px;
            margin-bottom: 24px;
        }

        .hero-title {
            font-size: clamp(2.4rem, 5.5vw, 4.2rem);
            font-weight: 800;
            line-height: 1.07;
            letter-spacing: -.03em;
            color: #f8fafc;
        }

        .hero-title .gradient-text {
            background: linear-gradient(135deg, #818cf8 0%, #38bdf8 50%, #34d399 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-desc {
            color: #94a3b8;
            font-size: 1.05rem;
            line-height: 1.75;
            max-width: 520px;
            margin: 20px 0 36px;
        }

        .btn-hero-primary {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: #fff;
            font-size: 14.5px;
            font-weight: 600;
            padding: 13px 28px;
            border-radius: 12px;
            text-decoration: none;
            letter-spacing: .01em;
            transition: all .25s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 8px 28px rgba(79, 70, 229, .4);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .btn-hero-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 36px rgba(79, 70, 229, .5);
        }

        .btn-hero-outline {
            border: 1.5px solid rgba(255, 255, 255, .2);
            color: #e2e8f0;
            font-size: 14.5px;
            font-weight: 600;
            padding: 13px 28px;
            border-radius: 12px;
            text-decoration: none;
            transition: all .25s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .btn-hero-outline:hover {
            border-color: #818cf8;
            color: #818cf8;
            background: rgba(129, 140, 248, .08);
        }

        /* Hero bottom stat bar */
        .hero-stat-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, .04);
            backdrop-filter: blur(12px);
            border-top: 1px solid rgba(255, 255, 255, .07);
            padding: 20px 0;
        }

        .hero-stat-item {
            text-align: center;
        }

        .hero-stat-val {
            font-family: 'Sora', sans-serif;
            font-size: 1.9rem;
            font-weight: 800;
            color: #fff;
            display: block;
            line-height: 1;
        }

        .hero-stat-label {
            color: #64748b;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .07em;
            display: block;
            margin-top: 5px;
        }

        .hero-stat-divider {
            width: 1px;
            height: 40px;
            background: rgba(255, 255, 255, .1);
            align-self: center;
        }

        /* ─── Section shared ─── */
        .section-chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: 5px 13px;
            border-radius: 99px;
            margin-bottom: 12px;
        }

        .section-title {
            font-size: clamp(1.75rem, 3.5vw, 2.4rem);
            font-weight: 800;
            letter-spacing: -.025em;
            color: #0f172a;
            line-height: 1.15;
        }

        .section-title em {
            font-style: normal;
            color: #4f46e5;
        }

        .section-desc {
            color: #64748b;
            font-size: 1rem;
            line-height: 1.75;
            max-width: 540px;
            margin-top: 12px;
        }

        .section-rule {
            width: 40px;
            height: 3px;
            border-radius: 2px;
            background: linear-gradient(90deg, #4f46e5, #38bdf8);
            margin: 14px 0;
        }

        /* ─── Cards ─── */
        .card-base {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            transition: all .3s cubic-bezier(.2, 0, 0, 1);
        }

        .card-base:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 48px rgba(15, 23, 42, .1);
            border-color: #c7d2fe;
        }

        .icon-chip {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            flex-shrink: 0;
        }

        /* ─── Exam cards ─── */
        .exam-card-ip {
            background: linear-gradient(150deg, #1e1b4b 0%, #312e81 40%, #4338ca 100%);
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            transition: all .35s;
        }

        .exam-card-ip::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(99, 102, 241, .15);
            pointer-events: none;
        }

        .exam-card-fe {
            background: linear-gradient(150deg, #042f2e 0%, #064e3b 40%, #047857 100%);
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            transition: all .35s;
        }

        .exam-card-fe::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(16, 185, 129, .12);
            pointer-events: none;
        }

        .exam-card-ip:hover,
        .exam-card-fe:hover {
            transform: translateY(-6px);
            box-shadow: 0 28px 60px rgba(0, 0, 0, .3);
        }

        .exam-tag {
            display: inline-block;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .22);
            color: #fff;
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 99px;
        }

        .exam-feat {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            padding: 9px 0;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            font-size: 13px;
        }

        .exam-feat:last-child {
            border-bottom: none;
        }

        .exam-feat-dot {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .15);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* ─── Stats section ─── */
        #stats-section {
            background: #0f172a;
            position: relative;
            overflow: hidden;
        }

        #stats-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 80% at 20% 50%, rgba(79, 70, 229, .2) 0%, transparent 60%),
                radial-gradient(ellipse 50% 60% at 80% 50%, rgba(14, 165, 233, .15) 0%, transparent 55%);
            pointer-events: none;
        }

        .stat-box {
            text-align: center;
            padding: 32px 24px;
            position: relative;
            z-index: 1;
        }

        .stat-num {
            font-family: 'Sora', sans-serif;
            font-size: 3rem;
            font-weight: 800;
            color: #fff;
            display: block;
            line-height: 1;
        }

        .stat-num sup {
            font-size: 1.2rem;
            color: #818cf8;
        }

        .stat-lbl {
            color: #64748b;
            font-size: 11.5px;
            text-transform: uppercase;
            letter-spacing: .07em;
            display: block;
            margin-top: 8px;
        }

        .stat-divider {
            width: 1px;
            background: rgba(255, 255, 255, .08);
            margin: 20px 0;
        }

        /* ─── Step cards ─── */
        .step-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px;
            border: 1px solid #e2e8f0;
            position: relative;
            transition: all .3s;
            text-align: center;
        }

        .step-card:hover {
            box-shadow: 0 12px 36px rgba(79, 70, 229, .12);
            border-color: #c7d2fe;
            transform: translateY(-4px);
        }

        .step-num {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, #4f46e5, #818cf8);
            color: #fff;
            font-family: 'Sora', sans-serif;
            font-size: 20px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            box-shadow: 0 6px 18px rgba(79, 70, 229, .35);
        }

        /* ─── Date cards ─── */
        .date-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 18px;
            transition: all .25s;
        }

        .date-card:hover {
            border-color: #c7d2fe;
            box-shadow: 0 8px 28px rgba(79, 70, 229, .1);
            transform: translateX(4px);
        }

        .date-badge-wrap .month-lbl {
            background: #4f46e5;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            padding: 3px 8px;
            border-radius: 5px 5px 0 0;
            display: block;
            text-align: center;
        }

        .date-badge-wrap .day-lbl {
            background: #eef2ff;
            color: #4338ca;
            font-family: 'Sora', sans-serif;
            font-size: 26px;
            font-weight: 800;
            padding: 4px 10px;
            border-radius: 0 0 5px 5px;
            display: block;
            text-align: center;
            line-height: 1.1;
        }

        .status-pill {
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            padding: 3px 11px;
            border-radius: 99px;
        }

        .status-open {
            background: #dcfce7;
            color: #166534;
        }

        .status-soon {
            background: #fff7ed;
            color: #9a3412;
        }

        .status-closed {
            background: #fce7f3;
            color: #831843;
        }

        /* ─── Venues ─── */
        .venue-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            padding: 28px 22px;
            text-align: center;
            transition: all .3s;
            cursor: pointer;
        }

        .venue-card:hover {
            border-color: #a5b4fc;
            box-shadow: 0 16px 40px rgba(79, 70, 229, .14);
            transform: translateY(-5px);
        }

        .venue-pin-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 26px;
        }

        /* ─── Notice rows ─── */
        .notice-row {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding: 14px 0;
            border-bottom: 1px solid #f1f5f9;
            transition: all .18s;
            cursor: pointer;
        }

        .notice-row:last-child {
            border-bottom: none;
        }

        .notice-row:hover {
            padding-left: 8px;
        }

        .notice-icon-box {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: #eef2ff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .notice-cat {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .07em;
            text-transform: uppercase;
            padding: 2px 9px;
            border-radius: 99px;
        }

        .nc-exam {
            background: #eef2ff;
            color: #3730a3;
        }

        .nc-result {
            background: #fff7ed;
            color: #9a3412;
        }

        .nc-general {
            background: #f0fdf4;
            color: #166534;
        }

        /* ─── Tab buttons ─── */
        .tab-btn {
            padding: 7px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 12.5px;
            font-weight: 600;
            transition: all .2s;
            background: transparent;
            color: #64748b;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .tab-btn.active {
            background: #4f46e5;
            color: #fff;
            box-shadow: 0 4px 14px rgba(79, 70, 229, .3);
        }

        /* ─── Partners ─── */
        .partner-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            padding: 28px 24px;
            text-align: center;
            transition: all .3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 120px;
        }

        .partner-card:hover {
            border-color: #c7d2fe;
            box-shadow: 0 10px 32px rgba(79, 70, 229, .1);
            transform: scale(1.02);
        }

        /* ─── Footer ─── */
        #footer {
            background: #020617;
            color: #64748b;
        }

        #footer a {
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
            display: block;
            padding: 3px 0;
            transition: color .18s;
        }

        #footer a:hover {
            color: #a5b4fc;
        }

        .footer-head {
            color: #e2e8f0;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: 14.5px;
            margin-bottom: 18px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, .07);
        }

        .footer-bottom {
            background: rgba(0, 0, 0, .4);
            border-top: 1px solid rgba(255, 255, 255, .05);
        }

        /* ─── Reveal animation ─── */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity .65s ease, transform .65s ease;
        }

        .reveal.in {
            opacity: 1;
            transform: none;
        }

        .d1 {
            transition-delay: .08s;
        }

        .d2 {
            transition-delay: .16s;
        }

        .d3 {
            transition-delay: .24s;
        }

        .d4 {
            transition-delay: .32s;
        }

        /* ─── Back to top ─── */
        #btt {
            position: fixed;
            bottom: 28px;
            right: 28px;
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: #4f46e5;
            border: none;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #fff;
            box-shadow: 0 8px 24px rgba(79, 70, 229, .4);
            transition: all .25s;
            z-index: 90;
        }

        #btt:hover {
            background: #4338ca;
            transform: translateY(-2px);
        }

        /* ─── Mobile menu ─── */
        #mob-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height .35s ease;
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
        }

        #mob-menu.open {
            max-height: 440px;
        }

        #navbar.scrolled #mob-menu {
            background: #0f172a;
            border-color: rgba(99, 102, 241, .2);
        }

        /* ─── Canvas ─── */
        #hero-canvas {
            position: absolute;
            inset: 0;
            pointer-events: none;
            opacity: .6;
        }

        /* ─── Responsive ─── */
        @media (max-width: 768px) {
            #desktop-nav {
                display: none !important;
            }

            #hamburger {
                display: flex !important;
            }

            .hero-grid {
                grid-template-columns: 1fr !important;
            }

            .exam-grid {
                grid-template-columns: 1fr !important;
            }

            .step-grid {
                grid-template-columns: 1fr 1fr !important;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr !important;
            }

            .venue-grid {
                grid-template-columns: 1fr 1fr !important;
            }

            .news-grid {
                grid-template-columns: 1fr !important;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr !important;
            }
        }

        @media (max-width: 480px) {
            .step-grid {
                grid-template-columns: 1fr !important;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr !important;
            }

            .venue-grid {
                grid-template-columns: 1fr 1fr !important;
            }

            .footer-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</head>

<body>

    <!-- ════════════════════════════════
     GOV TOP BAR
════════════════════════════════ -->
    <div id="govbar">
        <div
            style="max-width:1200px;margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
            <div style="display:flex;align-items:center;gap:10px">


            </div>
            <div style="display:flex;align-items:center;gap:20px;flex-wrap:wrap">
                <a href="#">ICT Division</a>
                <span style="color:rgba(255,255,255,.15);font-size:14px">|</span>
                <a href="#">Bangladesh Computer Council</a>
                <span style="color:rgba(255,255,255,.15);font-size:14px">|</span>
                <a href="#" style="display:flex;align-items:center;gap:5px">
                    <span class="ms" style="font-size:13px;color:#a5b4fc">mail</span>Contact
                </a>
            </div>
        </div>
    </div>

    <!-- ════════════════════════════════
     NAVBAR
════════════════════════════════ -->
    <nav id="navbar">
        <div
            style="max-width:1200px;margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:space-between;height:66px">
            <!-- Logo -->
            <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:13px;text-decoration:none">
                <img src="{{ asset('assets/bditecLogo.png') }}" alt="ITEE Logo">
            </a>

            <!-- Desktop links -->
            <div id="desktop-nav" style="display:flex;align-items:center;gap:2px">
                <a href="#about" class="nav-link">About ITEE</a>
                <a href="#exams" class="nav-link">Exam Levels</a>
                <a href="#schedule" class="nav-link">Exam Dates</a>
                <a href="#venues" class="nav-link">Venues</a>
                <a href="#news" class="nav-link">Notices</a>
                <a href="#partners" class="nav-link">Partners</a>
            </div>

            <div style="display:flex;align-items:center;gap:10px">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="cta-btn">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="cta-btn">Register</a>
                        @endif
                    @endauth
                @endif
                <button id="hamburger"
                    style="display:none;background:none;border:none;cursor:pointer;padding:4px;align-items:center;justify-content:center"
                    aria-label="Menu">
                    <span class="ms" id="burger-icon" style="font-size:26px;color:#334155">menu</span>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mob-menu">
            <div style="padding:12px 24px 18px;display:flex;flex-direction:column;gap:2px">
                <a href="#about" class="nav-link">About ITEE</a>
                <a href="#exams" class="nav-link">Exam Levels</a>
                <a href="#schedule" class="nav-link">Exam Dates</a>
                <a href="#venues" class="nav-link">Venues</a>
                <a href="#news" class="nav-link">Notices</a>
                <a href="#partners" class="nav-link">Partners</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="cta-btn" style="margin-top:10px;text-align:center">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="cta-btn" style="margin-top:10px;text-align:center">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- ════════════════════════════════
     HERO
════════════════════════════════ -->
    <section id="hero">
        <canvas id="hero-canvas"></canvas>
        <div class="hero-grid-bg"></div>

        <div style="max-width:1200px;margin:0 auto;padding:80px 24px 120px;width:100%;display:grid;grid-template-columns:1fr 1fr;gap:56px;align-items:center"
            class="hero-grid">
            <!-- Left -->
            <div>
                <div class="hero-badge">
                    <span class="ms" style="font-size:13px">public</span>
                    Bangladesh · IPA Japan · ITPEC Member
                </div>
                <h1 class="hero-title">
                    Elevate Your<br>
                    <span class="gradient-text">IT Career</span><br>
                    with ITEE
                </h1>
                <p class="hero-desc">
                    The globally recognized IT Engineers Examination, governed by IPA Japan and conducted in Bangladesh
                    by BCC since 2013. Open to all — students, graduates, and working professionals.
                </p>
                <div style="display:flex;gap:12px;flex-wrap:wrap">
                    <a href="#" class="btn-hero-primary">
                        Register for Exam
                        <span class="ms" style="font-size:18px">arrow_forward</span>
                    </a>
                    <a href="#about" class="btn-hero-outline">
                        <span class="ms" style="font-size:17px">play_circle</span>
                        Learn More
                    </a>
                </div>

                <!-- Trust indicators -->
                <div
                    style="display:flex;align-items:center;gap:20px;margin-top:44px;padding-top:32px;border-top:1px solid rgba(255,255,255,.08);flex-wrap:wrap">
                    <div style="display:flex;align-items:center;gap-8px">
                        <div style="display:flex;margin-right:8px">
                            <!-- Stacked avatar initials (no SVG) -->
                            <div
                                style="width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,#818cf8,#6366f1);border:2px solid #0f172a;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#fff;z-index:3">
                                R</div>
                            <div
                                style="width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,#34d399,#059669);border:2px solid #0f172a;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#fff;z-index:2;margin-left:-8px">
                                S</div>
                            <div
                                style="width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,#38bdf8,#0284c7);border:2px solid #0f172a;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#fff;z-index:1;margin-left:-8px">
                                A</div>
                        </div>
                        <div>
                            <div style="color:#e2e8f0;font-size:13px;font-weight:600">Thousands of passers</div>
                            <div style="color:#475569;font-size:11.5px">since October 2013</div>
                        </div>
                    </div>
                    <div style="width:1px;height:32px;background:rgba(255,255,255,.1)"></div>
                    <div style="display:flex;align-items:center;gap:7px">
                        <span class="ms" style="color:#fbbf24;font-size:20px">verified</span>
                        <div>
                            <div style="color:#e2e8f0;font-size:13px;font-weight:600">Internationally certified</div>
                            <div style="color:#475569;font-size:11.5px">10+ ITPEC countries</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: floating card cluster -->
            <div style="display:flex;flex-direction:column;gap:14px">
                <!-- Main card -->
                <div
                    style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:20px;padding:26px;backdrop-filter:blur(12px)">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px">
                        <span
                            style="color:#94a3b8;font-size:11.5px;font-weight:600;letter-spacing:.07em;text-transform:uppercase">Upcoming
                            Examination</span>
                        <span
                            style="background:rgba(52,211,153,.15);border:1px solid rgba(52,211,153,.3);color:#34d399;font-size:10.5px;font-weight:700;padding:3px 10px;border-radius:99px">Open</span>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
                        <div style="background:rgba(255,255,255,.06);border-radius:12px;padding:16px">
                            <div
                                style="font-family:'Sora',sans-serif;font-size:20px;font-weight:800;color:#818cf8;line-height:1">
                                IP Exam</div>
                            <div style="color:#94a3b8;font-size:12px;margin-top:5px;font-weight:500">Level 1 — Passport
                            </div>
                            <div style="margin-top:10px;font-size:11px;color:#64748b">For all graduates &amp;
                                professionals</div>
                        </div>
                        <div style="background:rgba(255,255,255,.06);border-radius:12px;padding:16px">
                            <div
                                style="font-family:'Sora',sans-serif;font-size:20px;font-weight:800;color:#34d399;line-height:1">
                                FE Exam</div>
                            <div style="color:#94a3b8;font-size:12px;margin-top:5px;font-weight:500">Level 2 —
                                Fundamental</div>
                            <div style="margin-top:10px;font-size:11px;color:#64748b">For CSE/IT students &amp;
                                engineers</div>
                        </div>
                    </div>
                    <div
                        style="margin-top:16px;padding-top:14px;border-top:1px solid rgba(255,255,255,.07);display:flex;align-items:center;justify-content:space-between">
                        <div style="display:flex;align-items:center;gap:6px;color:#64748b;font-size:12px">
                            <span class="ms" style="font-size:15px;color:#64748b">calendar_month</span>
                            April / May 2026
                        </div>
                        <a href="#"
                            style="color:#818cf8;font-size:12px;font-weight:600;text-decoration:none;display:flex;align-items:center;gap:3px">
                            Details <span class="ms" style="font-size:15px">chevron_right</span>
                        </a>
                    </div>
                </div>

                <!-- Two small info cards -->
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
                    <div
                        style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:14px;padding:16px;backdrop-filter:blur(12px)">
                        <div
                            style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#fbbf24,#f59e0b);display:flex;align-items:center;justify-content:center;margin-bottom:10px">
                            <span class="ms" style="color:#fff;font-size:20px">emoji_events</span>
                        </div>
                        <div style="color:#e2e8f0;font-size:13px;font-weight:600;line-height:1.3">Top Gun Program</div>
                        <div style="color:#64748b;font-size:11.5px;margin-top:5px;line-height:1.5">Earn a sponsored
                            training trip to Japan</div>
                    </div>
                    <div
                        style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:14px;padding:16px;backdrop-filter:blur(12px)">
                        <div
                            style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#34d399,#059669);display:flex;align-items:center;justify-content:center;margin-bottom:10px">
                            <span class="ms" style="color:#fff;font-size:20px">workspace_premium</span>
                        </div>
                        <div style="color:#e2e8f0;font-size:13px;font-weight:600;line-height:1.3">IPA Certificate</div>
                        <div style="color:#64748b;font-size:11.5px;margin-top:5px;line-height:1.5">Top 3 scorers receive
                            IPA Japan award</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats bar at bottom of hero -->
        <div class="hero-stat-bar">
            <div
                style="max-width:1200px;margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:0">
                <div class="hero-stat-item" style="flex:1">
                    <span class="hero-stat-val" data-count="12">0</span>
                    <span class="hero-stat-label">Years Active</span>
                </div>
                <div class="hero-stat-divider"></div>
                <div class="hero-stat-item" style="flex:1">
                    <span class="hero-stat-val" data-count="4">0</span>
                    <span class="hero-stat-label">Exam Venues</span>
                </div>
                <div class="hero-stat-divider"></div>
                <div class="hero-stat-item" style="flex:1">
                    <span class="hero-stat-val">2×</span>
                    <span class="hero-stat-label">Per Year</span>
                </div>
                <div class="hero-stat-divider"></div>
                <div class="hero-stat-item" style="flex:1">
                    <span class="hero-stat-val" data-count="10">0</span>
                    <span class="hero-stat-label">ITPEC Countries</span>
                </div>
                <div class="hero-stat-divider"></div>
                <div class="hero-stat-item" style="flex:1">
                    <span class="hero-stat-val">MCQ</span>
                    <span class="hero-stat-label">No Negative Mark</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════
     NOTICE TICKER
════════════════════════════════ -->
    <div id="ticker">
        <div style="max-width:1200px;margin:0 auto;display:flex;align-items:center;padding:0 24px;overflow:hidden">
            <div
                style="flex-shrink:0;background:#f59e0b;color:#fff;font-size:10.5px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;padding:4px 13px;border-radius:99px;margin-right:16px;display:flex;align-items:center;gap:5px">
                <span class="ms" style="font-size:13px;color:#fff">notifications</span>NOTICE
            </div>
            <div style="overflow:hidden;flex:1">
                <div class="ticker-inner">
                    <span class="ticker-item"><span class="ticker-dot"></span>Registration open for IP &amp; FE Exam —
                        Spring Session April/May 2026. Deadline: 31 March 2026.</span>
                    <span class="ticker-item"><span class="ticker-dot"></span>Free 30-hour online FE training program
                        starts 4 October 2025. All registered FE candidates eligible.</span>
                    <span class="ticker-item"><span class="ticker-dot"></span>IP Exam Result (October 2024) is now
                        published. View results on our portal.</span>
                    <span class="ticker-item"><span class="ticker-dot"></span>Certificate collection for October 2024
                        passers — contact BCC Agargaon office.</span>
                    <span class="ticker-item"><span class="ticker-dot"></span>Exam venues: Dhaka, Chittagong, Rajshahi
                        and Khulna. Choose your preferred location at registration.</span>
                    <!-- Duplicate for seamless loop -->
                    <span class="ticker-item"><span class="ticker-dot"></span>Registration open for IP &amp; FE Exam —
                        Spring Session April/May 2026. Deadline: 31 March 2026.</span>
                    <span class="ticker-item"><span class="ticker-dot"></span>Free 30-hour online FE training program
                        starts 4 October 2025. All registered FE candidates eligible.</span>
                    <span class="ticker-item"><span class="ticker-dot"></span>IP Exam Result (October 2024) is now
                        published. View results on our portal.</span>
                    <span class="ticker-item"><span class="ticker-dot"></span>Certificate collection for October 2024
                        passers — contact BCC Agargaon office.</span>
                    <span class="ticker-item"><span class="ticker-dot"></span>Exam venues: Dhaka, Chittagong, Rajshahi
                        and Khulna. Choose your preferred location at registration.</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ════════════════════════════════
     ABOUT ITEE
════════════════════════════════ -->
    <section id="about" style="padding:96px 24px;background:#fff">
        <div style="max-width:1200px;margin:0 auto">
            <div style="text-align:center;margin-bottom:56px" class="reveal">
                <div class="section-chip">
                    <span class="ms" style="font-size:13px">info</span>What is ITEE?
                </div>
                <h2 class="section-title">Japan's Premier IT Exam, <em>Now in Bangladesh</em></h2>
                <div class="section-rule" style="margin:14px auto"></div>
                <p class="section-desc" style="margin:0 auto;text-align:center;max-width:580px">
                    ITEE (Information Technology Engineers Examination) is Japan's national IT qualification — one of
                    the largest IT exams globally, with ~600,000 applicants per year. Bangladesh has been an ITPEC
                    member conducting ITEE since October 2013.
                </p>
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:22px">
                <div class="card-base reveal d1" style="padding:28px">
                    <div class="icon-chip" style="background:#eef2ff;margin-bottom:18px">
                        <span class="ms" style="color:#4f46e5;font-size:28px">public</span>
                    </div>
                    <h3 style="font-size:16px;font-weight:700;color:#0f172a;margin-bottom:8px">Global Recognition</h3>
                    <p style="color:#64748b;font-size:13.5px;line-height:1.7">ITEE certificates are recognized across
                        all 10+ ITPEC member countries, greatly boosting your international career prospects in the IT
                        industry.</p>
                </div>

                <div class="card-base reveal d2" style="padding:28px">
                    <div class="icon-chip" style="background:#f0fdf4;margin-bottom:18px">
                        <span class="ms" style="color:#16a34a;font-size:28px">school</span>
                    </div>
                    <h3 style="font-size:16px;font-weight:700;color:#0f172a;margin-bottom:8px">Two Exam Levels</h3>
                    <p style="color:#64748b;font-size:13.5px;line-height:1.7">Level 1 (IP) suits all graduates and
                        non-IT professionals. Level 2 (FE) targets IT engineers and final-year CSE students looking for
                        professional certification.</p>
                </div>

                <div class="card-base reveal d3" style="padding:28px">
                    <div class="icon-chip" style="background:#fff7ed;margin-bottom:18px">
                        <span class="ms" style="color:#ea580c;font-size:28px">block</span>
                    </div>
                    <h3 style="font-size:16px;font-weight:700;color:#0f172a;margin-bottom:8px">No Prerequisites</h3>
                    <p style="color:#64748b;font-size:13.5px;line-height:1.7">No age limit, no degree requirement, and
                        no restriction on retakes. Any person — student or professional — can sit the exam as many times
                        as needed.</p>
                </div>

                <div class="card-base reveal d4" style="padding:28px">
                    <div class="icon-chip" style="background:#fdf4ff;margin-bottom:18px">
                        <span class="ms" style="color:#9333ea;font-size:28px">calendar_month</span>
                    </div>
                    <h3 style="font-size:16px;font-weight:700;color:#0f172a;margin-bottom:8px">Held Twice a Year</h3>
                    <p style="color:#64748b;font-size:13.5px;line-height:1.7">Exams run in April/May and October —
                        simultaneously across all ITPEC countries with the same question set and timing.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════
     EXAM LEVELS
════════════════════════════════ -->
    <section id="exams" style="padding:96px 24px;background:#f8fafc">
        <div style="max-width:1200px;margin:0 auto">
            <div style="display:grid;grid-template-columns:1fr 2.2fr;gap:56px;align-items:start" class="exam-grid">
                <!-- Left -->
                <div class="reveal">
                    <div class="section-chip">
                        <span class="ms" style="font-size:13px">assignment</span>Examination
                    </div>
                    <h2 class="section-title">Choose Your<br><em>Exam Level</em></h2>
                    <div class="section-rule"></div>
                    <p class="section-desc">Both exams are paper-based MCQ with no negative marking. Register for both
                        together during the same window.</p>

                    <div
                        style="margin-top:28px;background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:20px;border-left:4px solid #f59e0b">
                        <div style="display:flex;align-items:center;gap:7px;margin-bottom:7px">
                            <span class="ms" style="font-size:18px;color:#f59e0b">info</span>
                            <span style="font-size:13.5px;font-weight:700;color:#0f172a">Half Passer Rule (FE
                                Only)</span>
                        </div>
                        <p style="font-size:12.5px;color:#64748b;line-height:1.6">Pass only the morning or afternoon
                            session? You're a "Half Passer" — you have 2 more attempts within 1 year to clear the
                            remaining part.</p>
                    </div>
                </div>

                <!-- Right: exam cards -->
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:22px">
                    <!-- IP Card -->
                    <div class="exam-card-ip reveal d1" style="padding:32px;position:relative">
                        <div
                            style="position:absolute;font-family:'Sora',sans-serif;font-size:7rem;font-weight:900;color:rgba(255,255,255,.05);right:16px;top:8px;line-height:1;pointer-events:none;user-select:none">
                            1</div>
                        <div class="exam-tag" style="margin-bottom:20px">Level 1</div>
                        <h3
                            style="color:#fff;font-family:'Sora',sans-serif;font-size:1.6rem;font-weight:800;line-height:1.15;margin-bottom:6px">
                            IT Passport<br>Exam <span style="color:#a5b4fc">(IP)</span></h3>
                        <p style="color:#a5b4fc;font-size:12.5px;line-height:1.6;margin-bottom:22px">Ideal for IT &amp;
                            non-IT graduates seeking internationally recognized IT literacy certification.</p>
                        <div>
                            <div class="exam-feat">
                                <div class="exam-feat-dot"><span class="ms"
                                        style="font-size:11px;color:#fff">check</span></div>
                                <span style="color:#c7d2fe;font-size:12.5px">40% IT · 35% Strategy · 25%
                                    Management</span>
                            </div>
                            <div class="exam-feat">
                                <div class="exam-feat-dot"><span class="ms"
                                        style="font-size:11px;color:#fff">check</span></div>
                                <span style="color:#c7d2fe;font-size:12.5px">MCQ — No negative marking</span>
                            </div>
                            <div class="exam-feat">
                                <div class="exam-feat-dot"><span class="ms"
                                        style="font-size:11px;color:#fff">check</span></div>
                                <span style="color:#c7d2fe;font-size:12.5px">Single morning session only</span>
                            </div>
                            <div class="exam-feat">
                                <div class="exam-feat-dot"><span class="ms"
                                        style="font-size:11px;color:#fff">check</span></div>
                                <span style="color:#c7d2fe;font-size:12.5px">Open to all — no prerequisites</span>
                            </div>
                        </div>
                        <a href="#"
                            style="display:inline-flex;align-items:center;gap:5px;margin-top:22px;background:rgba(165,180,252,.15);border:1px solid rgba(165,180,252,.3);color:#a5b4fc;padding:9px 18px;border-radius:9px;font-size:12.5px;font-weight:600;text-decoration:none;transition:all .2s"
                            onmouseover="this.style.background='rgba(165,180,252,.25)'"
                            onmouseout="this.style.background='rgba(165,180,252,.15)'">
                            Learn More <span class="ms" style="font-size:15px">arrow_forward</span>
                        </a>
                    </div>

                    <!-- FE Card -->
                    <div class="exam-card-fe reveal d2" style="padding:32px;position:relative">
                        <div
                            style="position:absolute;font-family:'Sora',sans-serif;font-size:7rem;font-weight:900;color:rgba(255,255,255,.05);right:16px;top:8px;line-height:1;pointer-events:none;user-select:none">
                            2</div>
                        <div class="exam-tag" style="margin-bottom:20px">Level 2</div>
                        <h3
                            style="color:#fff;font-family:'Sora',sans-serif;font-size:1.6rem;font-weight:800;line-height:1.15;margin-bottom:6px">
                            Fundamental IT<br>Engineer <span style="color:#6ee7b7">(FE)</span></h3>
                        <p style="color:#6ee7b7;font-size:12.5px;line-height:1.6;margin-bottom:22px">For IT
                            professionals, graduates, and final-year CSE/IT students aiming for engineering-level
                            recognition.</p>
                        <div>
                            <div class="exam-feat">
                                <div class="exam-feat-dot"><span class="ms"
                                        style="font-size:11px;color:#fff">check</span></div>
                                <span style="color:#a7f3d0;font-size:12.5px">60% IT · 20% Strategy · 20%
                                    Management</span>
                            </div>
                            <div class="exam-feat">
                                <div class="exam-feat-dot"><span class="ms"
                                        style="font-size:11px;color:#fff">check</span></div>
                                <span style="color:#a7f3d0;font-size:12.5px">Two sessions: morning + afternoon</span>
                            </div>
                            <div class="exam-feat">
                                <div class="exam-feat-dot"><span class="ms"
                                        style="font-size:11px;color:#fff">check</span></div>
                                <span style="color:#a7f3d0;font-size:12.5px">Top Gun: sponsored Japan training</span>
                            </div>
                            <div class="exam-feat">
                                <div class="exam-feat-dot"><span class="ms"
                                        style="font-size:11px;color:#fff">check</span></div>
                                <span style="color:#a7f3d0;font-size:12.5px">IPA Japan cert for top 3 scorers</span>
                            </div>
                        </div>
                        <a href="#"
                            style="display:inline-flex;align-items:center;gap:5px;margin-top:22px;background:rgba(110,231,183,.15);border:1px solid rgba(110,231,183,.3);color:#6ee7b7;padding:9px 18px;border-radius:9px;font-size:12.5px;font-weight:600;text-decoration:none;transition:all .2s"
                            onmouseover="this.style.background='rgba(110,231,183,.25)'"
                            onmouseout="this.style.background='rgba(110,231,183,.15)'">
                            Learn More <span class="ms" style="font-size:15px">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════
     STATS
════════════════════════════════ -->
    <section id="stats-section" style="padding:72px 24px">
        <div style="max-width:1200px;margin:0 auto;display:grid;grid-template-columns:repeat(4,1fr)" class="stats-grid">
            <div class="stat-box reveal">
                <span class="stat-num" data-target="12">0<sup>+</sup></span>
                <span class="stat-lbl">Years Conducting ITEE</span>
            </div>
            <div class="stat-box reveal d1">
                <span class="stat-num" data-target="10">0<sup>+</sup></span>
                <span class="stat-lbl">ITPEC Member Countries</span>
            </div>
            <div class="stat-box reveal d2">
                <span class="stat-num" data-target="4">0</span>
                <span class="stat-lbl">Exam Venues in Bangladesh</span>
            </div>
            <div class="stat-box reveal d3">
                <span class="stat-num">600K<sup>+</sup></span>
                <span class="stat-lbl">Annual Applicants in Japan</span>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════
     HOW TO REGISTER
════════════════════════════════ -->
    <section style="padding:96px 24px;background:#fff">
        <div style="max-width:1200px;margin:0 auto">
            <div style="text-align:center;margin-bottom:54px" class="reveal">
                <div class="section-chip">
                    <span class="ms" style="font-size:13px">fact_check</span>Registration
                </div>
                <h2 class="section-title">How to <em>Apply</em></h2>
                <div class="section-rule" style="margin:14px auto"></div>
            </div>

            <!-- Connecting line behind steps -->
            <div style="position:relative">
                <div
                    style="position:absolute;top:48px;left:calc(12.5% + 24px);right:calc(12.5% + 24px);height:1.5px;background:linear-gradient(90deg,#4f46e5,#38bdf8);opacity:.2;pointer-events:none">
                </div>
                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:22px;position:relative"
                    class="step-grid">
                    <div class="step-card reveal d1">
                        <div class="step-num">1</div>
                        <h4 style="font-size:15px;font-weight:700;color:#0f172a;margin-bottom:8px">Visit the Portal</h4>
                        <p style="color:#64748b;font-size:13px;line-height:1.65">Go to registration.bditec.gov.bd and
                            create an account with your valid email address.</p>
                    </div>
                    <div class="step-card reveal d2">
                        <div class="step-num">2</div>
                        <h4 style="font-size:15px;font-weight:700;color:#0f172a;margin-bottom:8px">Fill the Form</h4>
                        <p style="color:#64748b;font-size:13px;line-height:1.65">Select IP or FE exam level, choose your
                            nearest venue city, and complete your personal details.</p>
                    </div>
                    <div class="step-card reveal d3">
                        <div class="step-num">3</div>
                        <h4 style="font-size:15px;font-weight:700;color:#0f172a;margin-bottom:8px">Pay via bKash</h4>
                        <p style="color:#64748b;font-size:13px;line-height:1.65">Send the exam fee to the BCC Merchant
                            Account via bKash and submit your transaction reference.</p>
                    </div>
                    <div class="step-card reveal d4">
                        <div class="step-num" style="background:linear-gradient(135deg,#059669,#34d399)">4</div>
                        <h4 style="font-size:15px;font-weight:700;color:#0f172a;margin-bottom:8px">Sit & Get Certified
                        </h4>
                        <p style="color:#64748b;font-size:13px;line-height:1.65">Bring your photo ID on exam day. Pass
                            to receive your internationally recognized ITEE certificate.</p>
                    </div>
                </div>
            </div>

            <div style="text-align:center;margin-top:40px">
                <a href="#" class="btn-hero-primary" style="display:inline-flex">
                    Start Your Registration
                    <span class="ms" style="font-size:18px">arrow_forward</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════
     EXAM SCHEDULE
════════════════════════════════ -->
    <section id="schedule" style="padding:96px 24px;background:#f8fafc">
        <div style="max-width:1200px;margin:0 auto;display:grid;grid-template-columns:1fr 2fr;gap:54px;align-items:start"
            class="exam-grid">
            <div class="reveal">
                <div class="section-chip">
                    <span class="ms" style="font-size:13px">event</span>Calendar
                </div>
                <h2 class="section-title">Important<br><em>Dates</em></h2>
                <div class="section-rule"></div>
                <p class="section-desc">Exams are conducted twice yearly. Always register before the announced deadline.
                </p>
                <div style="margin-top:24px;display:flex;flex-direction:column;gap:8px">
                    <div style="display:flex;align-items:center;gap:8px;font-size:12.5px;color:#64748b">
                        <span
                            style="width:10px;height:10px;border-radius:50%;background:#16a34a;display:inline-block;flex-shrink:0"></span>Open
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;font-size:12.5px;color:#64748b">
                        <span
                            style="width:10px;height:10px;border-radius:50%;background:#ea580c;display:inline-block;flex-shrink:0"></span>Upcoming
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;font-size:12.5px;color:#64748b">
                        <span
                            style="width:10px;height:10px;border-radius:50%;background:#be185d;display:inline-block;flex-shrink:0"></span>Closed
                    </div>
                </div>
            </div>

            <div style="display:flex;flex-direction:column;gap:12px">
                <div class="date-card reveal">
                    <div class="date-badge-wrap" style="flex-shrink:0">
                        <span class="month-lbl">Apr</span>
                        <span class="day-lbl">26</span>
                    </div>
                    <div style="flex:1">
                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:5px;flex-wrap:wrap">
                            <span style="font-weight:700;color:#0f172a;font-size:15px">IP &amp; FE Exam — Spring
                                2026</span>
                            <span class="status-pill status-open">Open</span>
                        </div>
                        <div style="color:#64748b;font-size:12.5px">Registration closes 31 March 2026</div>
                        <div
                            style="color:#94a3b8;font-size:11.5px;margin-top:4px;display:flex;align-items:center;gap:5px">
                            <span class="ms" style="font-size:13px;color:#94a3b8">location_on</span>Dhaka · Chittagong ·
                            Rajshahi · Khulna
                        </div>
                    </div>
                    <span class="ms" style="color:#c7d2fe;font-size:20px;flex-shrink:0">chevron_right</span>
                </div>

                <div class="date-card reveal d1" style="border-left-color:#16a34a">
                    <div class="date-badge-wrap" style="flex-shrink:0">
                        <span class="month-lbl" style="background:#16a34a">Mar</span>
                        <span class="day-lbl" style="background:#dcfce7;color:#166534">31</span>
                    </div>
                    <div style="flex:1">
                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:5px;flex-wrap:wrap">
                            <span style="font-weight:700;color:#0f172a;font-size:15px">Registration Deadline — Spring
                                2026</span>
                            <span class="status-pill status-soon">Upcoming</span>
                        </div>
                        <div style="color:#64748b;font-size:12.5px">Submit form and bKash payment confirmation before
                            midnight</div>
                    </div>
                    <span class="ms" style="color:#c7d2fe;font-size:20px;flex-shrink:0">chevron_right</span>
                </div>

                <div class="date-card reveal d2" style="border-left-color:#9ca3af;opacity:.65">
                    <div class="date-badge-wrap" style="flex-shrink:0">
                        <span class="month-lbl" style="background:#6b7280">Oct</span>
                        <span class="day-lbl" style="background:#f3f4f6;color:#374151">25</span>
                    </div>
                    <div style="flex:1">
                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:5px;flex-wrap:wrap">
                            <span style="font-weight:700;color:#0f172a;font-size:15px">IP &amp; FE Exam — Autumn
                                2025</span>
                            <span class="status-pill status-closed">Closed</span>
                        </div>
                        <div style="color:#64748b;font-size:12.5px">Results published — check the Results page</div>
                    </div>
                    <span class="ms" style="color:#e2e8f0;font-size:20px;flex-shrink:0">chevron_right</span>
                </div>

                <div class="date-card reveal d3" style="border-left-color:#9ca3af;opacity:.5">
                    <div class="date-badge-wrap" style="flex-shrink:0">
                        <span class="month-lbl" style="background:#6b7280">Apr</span>
                        <span class="day-lbl" style="background:#f3f4f6;color:#374151">27</span>
                    </div>
                    <div style="flex:1">
                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:5px;flex-wrap:wrap">
                            <span style="font-weight:700;color:#0f172a;font-size:15px">IP &amp; FE Exam — Spring
                                2025</span>
                            <span class="status-pill status-closed">Closed</span>
                        </div>
                        <div style="color:#64748b;font-size:12.5px">Results published — check the Results page</div>
                    </div>
                    <span class="ms" style="color:#e2e8f0;font-size:20px;flex-shrink:0">chevron_right</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════
     VENUES
════════════════════════════════ -->
    <section id="venues" style="padding:96px 24px;background:#fff">
        <div style="max-width:1200px;margin:0 auto">
            <div style="text-align:center;margin-bottom:52px" class="reveal">
                <div class="section-chip">
                    <span class="ms" style="font-size:13px">location_on</span>Exam Venues
                </div>
                <h2 class="section-title">Four Cities <em>Across Bangladesh</em></h2>
                <div class="section-rule" style="margin:14px auto"></div>
                <p class="section-desc" style="margin:0 auto;text-align:center">The examination is conducted
                    simultaneously at four venues on the same day and time.</p>
            </div>

            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px" class="venue-grid">
                <div class="venue-card reveal d1">
                    <div class="venue-pin-icon" style="background:#eef2ff">
                        <span class="ms" style="color:#4f46e5;font-size:28px">location_city</span>
                    </div>
                    <h3 style="font-family:'Sora',sans-serif;font-size:19px;font-weight:800;color:#0f172a">Dhaka</h3>
                    <p style="color:#64748b;font-size:12.5px;margin-top:7px;line-height:1.55">Bangladesh Computer
                        Council, ICT Tower, Agargaon</p>
                    <div style="margin-top:14px;padding-top:12px;border-top:1px solid #f1f5f9">
                        <span
                            style="background:#eef2ff;color:#4338ca;font-size:10.5px;font-weight:700;padding:4px 12px;border-radius:99px">Primary
                            Venue</span>
                    </div>
                </div>
                <div class="venue-card reveal d2">
                    <div class="venue-pin-icon" style="background:#f0fdf4">
                        <span class="ms" style="color:#16a34a;font-size:28px">location_city</span>
                    </div>
                    <h3 style="font-family:'Sora',sans-serif;font-size:19px;font-weight:800;color:#0f172a">Chittagong
                    </h3>
                    <p style="color:#64748b;font-size:12.5px;margin-top:7px;line-height:1.55">Chittagong University of
                        Engineering &amp; Technology</p>
                    <div style="margin-top:14px;padding-top:12px;border-top:1px solid #f1f5f9">
                        <span
                            style="background:#f0fdf4;color:#166534;font-size:10.5px;font-weight:700;padding:4px 12px;border-radius:99px">Regional
                            Venue</span>
                    </div>
                </div>
                <div class="venue-card reveal d3">
                    <div class="venue-pin-icon" style="background:#fff7ed">
                        <span class="ms" style="color:#ea580c;font-size:28px">location_city</span>
                    </div>
                    <h3 style="font-family:'Sora',sans-serif;font-size:19px;font-weight:800;color:#0f172a">Rajshahi</h3>
                    <p style="color:#64748b;font-size:12.5px;margin-top:7px;line-height:1.55">Rajshahi University of
                        Engineering &amp; Technology</p>
                    <div style="margin-top:14px;padding-top:12px;border-top:1px solid #f1f5f9">
                        <span
                            style="background:#fff7ed;color:#9a3412;font-size:10.5px;font-weight:700;padding:4px 12px;border-radius:99px">Regional
                            Venue</span>
                    </div>
                </div>
                <div class="venue-card reveal d4">
                    <div class="venue-pin-icon" style="background:#fdf4ff">
                        <span class="ms" style="color:#9333ea;font-size:28px">location_city</span>
                    </div>
                    <h3 style="font-family:'Sora',sans-serif;font-size:19px;font-weight:800;color:#0f172a">Khulna</h3>
                    <p style="color:#64748b;font-size:12.5px;margin-top:7px;line-height:1.55">Khulna University of
                        Engineering &amp; Technology</p>
                    <div style="margin-top:14px;padding-top:12px;border-top:1px solid #f1f5f9">
                        <span
                            style="background:#fdf4ff;color:#7e22ce;font-size:10.5px;font-weight:700;padding:4px 12px;border-radius:99px">Regional
                            Venue</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════
     NEWS & NOTICES
════════════════════════════════ -->
    <section id="news" style="padding:96px 24px;background:#f8fafc">
        <div style="max-width:1200px;margin:0 auto">
            <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:40px;flex-wrap:wrap;gap:16px"
                class="reveal">
                <div>
                    <div class="section-chip">
                        <span class="ms" style="font-size:13px">feed</span>Updates
                    </div>
                    <h2 class="section-title">News &amp; <em>Notices</em></h2>
                    <div class="section-rule"></div>
                </div>
                <!-- Tabs -->
                <div
                    style="background:#fff;border:1px solid #e2e8f0;border-radius:11px;padding:5px;display:flex;gap:4px">
                    <button class="tab-btn active" data-filter="all">All</button>
                    <button class="tab-btn" data-filter="exam">Exam</button>
                    <button class="tab-btn" data-filter="result">Results</button>
                    <button class="tab-btn" data-filter="general">General</button>
                </div>
            </div>

            <div style="display:grid;grid-template-columns:2fr 1fr;gap:28px;align-items:start" class="news-grid">
                <!-- Notices list -->
                <div style="background:#fff;border-radius:16px;border:1px solid #e2e8f0;padding:24px" class="reveal">
                    <div id="notice-list"></div>
                    <div style="text-align:center;margin-top:16px">
                        <a href="#"
                            style="color:#4f46e5;font-size:13px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:4px">
                            View All Notices <span class="ms" style="font-size:16px">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Downloads sidebar -->
                <div style="display:flex;flex-direction:column;gap:16px" class="reveal d1">
                    <!-- Download card -->
                    <div style="background:#0f172a;border-radius:16px;padding:22px">
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:18px">
                            <span class="ms" style="font-size:20px;color:#818cf8">download</span>
                            <span
                                style="color:#fff;font-family:'Sora',sans-serif;font-weight:700;font-size:14.5px">Downloads</span>
                        </div>
                        <div style="display:flex;flex-direction:column;gap:9px">
                            <a href="#"
                                style="display:flex;align-items:center;gap:10px;padding:11px;background:rgba(255,255,255,.06);border-radius:10px;text-decoration:none;transition:background .2s;border:1px solid rgba(255,255,255,.06)"
                                onmouseover="this.style.background='rgba(255,255,255,.12)'"
                                onmouseout="this.style.background='rgba(255,255,255,.06)'">
                                <div
                                    style="width:32px;height:32px;border-radius:8px;background:rgba(129,140,248,.2);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                                    <span class="ms" style="font-size:17px;color:#818cf8">description</span>
                                </div>
                                <div>
                                    <div style="color:#e2e8f0;font-size:13px;font-weight:600">FE Syllabus (PDF)</div>
                                    <div style="color:#475569;font-size:11px;margin-top:1px">Updated 2024</div>
                                </div>
                            </a>
                            <a href="#"
                                style="display:flex;align-items:center;gap:10px;padding:11px;background:rgba(255,255,255,.06);border-radius:10px;text-decoration:none;transition:background .2s;border:1px solid rgba(255,255,255,.06)"
                                onmouseover="this.style.background='rgba(255,255,255,.12)'"
                                onmouseout="this.style.background='rgba(255,255,255,.06)'">
                                <div
                                    style="width:32px;height:32px;border-radius:8px;background:rgba(52,211,153,.15);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                                    <span class="ms" style="font-size:17px;color:#34d399">quiz</span>
                                </div>
                                <div>
                                    <div style="color:#e2e8f0;font-size:13px;font-weight:600">Past Exam Questions</div>
                                    <div style="color:#475569;font-size:11px;margin-top:1px">IP &amp; FE — All years
                                    </div>
                                </div>
                            </a>
                            <a href="#"
                                style="display:flex;align-items:center;gap:10px;padding:11px;background:rgba(255,255,255,.06);border-radius:10px;text-decoration:none;transition:background .2s;border:1px solid rgba(255,255,255,.06)"
                                onmouseover="this.style.background='rgba(255,255,255,.12)'"
                                onmouseout="this.style.background='rgba(255,255,255,.06)'">
                                <div
                                    style="width:32px;height:32px;border-radius:8px;background:rgba(251,191,36,.15);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                                    <span class="ms" style="font-size:17px;color:#fbbf24">article</span>
                                </div>
                                <div>
                                    <div style="color:#e2e8f0;font-size:13px;font-weight:600">ITEE Brochure</div>
                                    <div style="color:#475569;font-size:11px;margin-top:1px">Overview &amp; Guide</div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Quick links -->
                    <div style="background:#fff;border-radius:14px;border:1px solid #e2e8f0;padding:20px">
                        <div
                            style="font-family:'Sora',sans-serif;font-weight:700;font-size:14px;color:#0f172a;margin-bottom:14px">
                            Quick Links</div>
                        <div style="display:flex;flex-direction:column;gap:2px">
                            <a href="#"
                                style="display:flex;align-items:center;gap:8px;color:#4f46e5;font-size:13px;font-weight:500;text-decoration:none;padding:9px 10px;border-radius:9px;transition:background .15s"
                                onmouseover="this.style.background='#eef2ff'"
                                onmouseout="this.style.background='transparent'">
                                <span class="ms" style="font-size:16px;color:#818cf8">arrow_forward</span>Check Exam
                                Results
                            </a>
                            <a href="#"
                                style="display:flex;align-items:center;gap:8px;color:#4f46e5;font-size:13px;font-weight:500;text-decoration:none;padding:9px 10px;border-radius:9px;transition:background .15s"
                                onmouseover="this.style.background='#eef2ff'"
                                onmouseout="this.style.background='transparent'">
                                <span class="ms" style="font-size:16px;color:#818cf8">arrow_forward</span>E-Learning
                                Portal
                            </a>
                            <a href="#"
                                style="display:flex;align-items:center;gap:8px;color:#4f46e5;font-size:13px;font-weight:500;text-decoration:none;padding:9px 10px;border-radius:9px;transition:background .15s"
                                onmouseover="this.style.background='#eef2ff'"
                                onmouseout="this.style.background='transparent'">
                                <span class="ms" style="font-size:16px;color:#818cf8">arrow_forward</span>Top Gun
                                Program
                            </a>
                            <a href="#"
                                style="display:flex;align-items:center;gap:8px;color:#4f46e5;font-size:13px;font-weight:500;text-decoration:none;padding:9px 10px;border-radius:9px;transition:background .15s"
                                onmouseover="this.style.background='#eef2ff'"
                                onmouseout="this.style.background='transparent'">
                                <span class="ms" style="font-size:16px;color:#818cf8">arrow_forward</span>ITPEC Official
                                Website
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════
     PARTNERS
════════════════════════════════ -->
    <section id="partners" style="padding:72px 24px;background:#fff">
        <div style="max-width:1200px;margin:0 auto">
            <div style="text-align:center;margin-bottom:40px" class="reveal">
                <div class="section-chip">
                    <span class="ms" style="font-size:13px">handshake</span>Partners & Affiliations
                </div>
                <h2 class="section-title">Backed by <em>Trusted Organizations</em></h2>
            </div>
            <div style="display:grid;grid-template-columns:repeat(5,1fr);gap:18px" class="venue-grid">
                <div class="partner-card reveal d1">
                    <img class="" src="{{ asset('assets/ipaLogoWithoutName.jpg') }}" alt="IPA Logo" />
                    <div style="font-family:'Sora',sans-serif;font-weight:800;font-size:14px;color:#0f172a">IPA Japan
                    </div>
                    <div style="color:#64748b;font-size:11.5px;margin-top:5px;text-align:center">
                        Information-technology<br>Promotion Agency, Japan</div>
                </div>
                <div class="partner-card reveal d2">
                    <img src="{{ asset('assets/bccLogo.png') }}" alt="BCC Logo" />
                    <div style="font-family:'Sora',sans-serif;font-weight:800;font-size:14px;color:#0f172a">Bangladesh
                        Computer Council</div>
                    <div style="color:#64748b;font-size:11.5px;margin-top:5px;text-align:center">Host Organization (BCC)
                    </div>
                </div>
                <div class="partner-card reveal d3">
                    <img src="{{ asset('assets/ictdLogo.png') }}" alt="IPA Logo" />
                    <div style="font-family:'Sora',sans-serif;font-weight:800;font-size:14px;color:#0f172a">ICT Division
                    </div>
                    <div style="color:#64748b;font-size:11.5px;margin-top:5px;text-align:center">Ministry of Posts
                        &amp;<br>Telecom, Bangladesh</div>
                </div>
                <div class="partner-card reveal d4">
                    <img src="{{ asset('assets/itpecLogo.gif') }}" alt="IPA Logo" />
                    <div style="font-family:'Sora',sans-serif;font-weight:800;font-size:14px;color:#0f172a">ITPEC</div>
                    <div style="color:#64748b;font-size:11.5px;margin-top:5px;text-align:center">Information Technology
                        Professionals
                        Examination Council</div>
                </div>
                <div class="partner-card reveal d5">
                    <img src="{{ asset('assets/jicaLogo.png') }}" alt="IPA Logo" />
                    <div style="font-family:'Sora',sans-serif;font-weight:800;font-size:14px;color:#0f172a">JICA</div>
                    <div style="color:#64748b;font-size:11.5px;margin-top:5px;text-align:center">Japan International
                        Cooperation Agency</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════
     FOOTER
════════════════════════════════ -->
    <footer id="footer">
        <div style="max-width:1200px;margin:0 auto;padding:64px 24px 40px;display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:40px"
            class="footer-grid">
            <!-- Brand -->
            <div>
                <div style="display:flex;align-items:center;gap:11px;margin-bottom:18px">

                    <div>
                        <div
                            style="color:#f8fafc;font-family:'Sora',sans-serif;font-weight:800;font-size:19px;line-height:1;letter-spacing:-.03em">
                            BD-ITEC</div>
                        <div
                            style="color:#4f46e5;font-size:9.5px;font-weight:700;letter-spacing:.07em;text-transform:uppercase">
                            IT Engineers Exam Center</div>
                    </div>
                </div>
                <p style="font-size:13px;line-height:1.75;max-width:270px;margin-bottom:22px">
                    Under Bangladesh Computer Council, BD-ITEC conducts the globally recognized ITEE in partnership with
                    IPA Japan since October 2013.
                </p>
                <!-- Social -->
                <div style="display:flex;gap:9px">
                    <a href="#"
                        style="width:36px;height:36px;border-radius:9px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;transition:all .2s"
                        onmouseover="this.style.background='rgba(79,70,229,.25)'"
                        onmouseout="this.style.background='rgba(255,255,255,.06)'">
                        <span class="ms" style="font-size:18px;color:#94a3b8">facebook</span>
                    </a>
                    <a href="#"
                        style="width:36px;height:36px;border-radius:9px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;transition:all .2s"
                        onmouseover="this.style.background='rgba(79,70,229,.25)'"
                        onmouseout="this.style.background='rgba(255,255,255,.06)'">
                        <span class="ms" style="font-size:18px;color:#94a3b8">mail</span>
                    </a>
                    <a href="#"
                        style="width:36px;height:36px;border-radius:9px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;transition:all .2s"
                        onmouseover="this.style.background='rgba(79,70,229,.25)'"
                        onmouseout="this.style.background='rgba(255,255,255,.06)'">
                        <span class="ms" style="font-size:18px;color:#94a3b8">play_circle</span>
                    </a>
                </div>
            </div>

            <div>
                <div class="footer-head">Examination</div>
                <a href="#">About ITEE</a>
                <a href="#">IP Exam — Level 1</a>
                <a href="#">FE Exam — Level 2</a>
                <a href="#">Exam Schedule</a>
                <a href="#">Exam Venues</a>
                <a href="#">Registration</a>
            </div>
            <div>
                <div class="footer-head">Resources</div>
                <a href="#">Past Questions</a>
                <a href="#">FE Syllabus</a>
                <a href="#">ITEE Brochure</a>
                <a href="#">E-Learning Portal</a>
                <a href="#">Top Gun Program</a>
                <a href="#">Study Materials</a>
            </div>
            <div>
                <div class="footer-head">Contact</div>
                <p style="font-size:12.5px;line-height:1.75;margin-bottom:12px">
                    Bangladesh Computer Council<br>
                    ICT Tower, Agargaon<br>
                    Sher-e-Bangla Nagar<br>
                    Dhaka-1207, Bangladesh
                </p>
                <a href="mailto:info@bditec.gov.bd"
                    style="color:#818cf8 !important;font-size:13px">info@bditec.gov.bd</a>
            </div>
        </div>
        <div class="footer-bottom">
            <div
                style="max-width:1200px;margin:0 auto;padding:15px 24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
                <div style="font-size:12px">© 2026 BD-ITEC — Bangladesh Computer Council. All rights reserved.</div>
                <div style="display:flex;gap:18px">
                    <a href="#" style="font-size:12px;display:inline">Privacy Policy</a>
                    <a href="#" style="font-size:12px;display:inline">Terms of Use</a>
                    <a href="#" style="font-size:12px;display:inline">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to top -->
    <button id="btt" aria-label="Back to top">
        <span class="ms" style="font-size:22px;pointer-events:none">keyboard_arrow_up</span>
    </button>

    <!-- ════════════════════════════════
     SCRIPTS
════════════════════════════════ -->
    <script>
        /* ── Hero Canvas: floating particles ── */
        (function () {
            const c = document.getElementById('hero-canvas');
            const ctx = c.getContext('2d');
            let pts = [], raf;
            function resize() { c.width = c.offsetWidth; c.height = c.offsetHeight; }

            function Pt() {
                this.x = Math.random() * c.width;
                this.y = Math.random() * c.height;
                this.vx = (Math.random() - .5) * .35;
                this.vy = (Math.random() - .5) * .35;
                this.r = Math.random() * 1.2 + .4;
                this.a = Math.random() * .55 + .15;
            }

            function init() {
                pts = [];
                const n = Math.min(90, ~~(c.width / 12));
                for (let i = 0; i < n; i++) pts.push(new Pt());
            }

            function draw() {
                ctx.clearRect(0, 0, c.width, c.height);
                for (let i = 0; i < pts.length; i++) {
                    const p = pts[i];
                    p.x += p.vx; p.y += p.vy;
                    if (p.x < 0 || p.x > c.width) p.vx *= -1;
                    if (p.y < 0 || p.y > c.height) p.vy *= -1;
                    for (let j = i + 1; j < pts.length; j++) {
                        const q = pts[j], dx = p.x - q.x, dy = p.y - q.y, d = Math.sqrt(dx * dx + dy * dy);
                        if (d < 110) {
                            ctx.beginPath();
                            ctx.moveTo(p.x, p.y); ctx.lineTo(q.x, q.y);
                            ctx.strokeStyle = `rgba(129,140,248,${.14 * (1 - d / 110)})`;
                            ctx.lineWidth = .7; ctx.stroke();
                        }
                    }
                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(165,180,252,${p.a})`;
                    ctx.fill();
                }
                raf = requestAnimationFrame(draw);
            }

            window.addEventListener('resize', () => { resize(); init(); });
            resize(); init(); draw();
        })();

        /* ── Navbar scroll effect ── */
        const navbar = document.getElementById('navbar');
        const btt = document.getElementById('btt');
        window.addEventListener('scroll', () => {
            const s = window.scrollY;
            navbar.classList.toggle('scrolled', s > 72);
            btt.style.display = s > 400 ? 'flex' : 'none';
        });
        btt.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

        /* ── Mobile hamburger ── */
        const burger = document.getElementById('hamburger');
        const mobMenu = document.getElementById('mob-menu');
        burger.addEventListener('click', () => mobMenu.classList.toggle('open'));
        document.querySelectorAll('#mob-menu a').forEach(a =>
            a.addEventListener('click', () => mobMenu.classList.remove('open'))
        );

        /* ── Smooth scroll for anchor links ── */
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const id = a.getAttribute('href');
                if (id === '#') { e.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' }); return; }
                const el = document.querySelector(id);
                if (el) { e.preventDefault(); el.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
            });
        });

        /* ── Scroll reveal ── */
        const revealObs = new IntersectionObserver(entries => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); revealObs.unobserve(e.target); } });
        }, { threshold: .1 });
        document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));

        /* ── Animated counters ── */
        function countUp(el, target, dur = 1800) {
            const start = performance.now();
            const sup = el.querySelector('sup') ? el.querySelector('sup').outerHTML : '';
            const update = now => {
                const p = Math.min((now - start) / dur, 1);
                const ease = 1 - Math.pow(1 - p, 3);
                const val = Math.round(ease * target);
                el.innerHTML = val + sup;
                if (p < 1) requestAnimationFrame(update);
            };
            requestAnimationFrame(update);
        }

        const cntObs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    const el = e.target, t = parseInt(el.dataset.target || el.dataset.count);
                    if (!isNaN(t)) countUp(el, t);
                    cntObs.unobserve(el);
                }
            });
        }, { threshold: .5 });
        document.querySelectorAll('[data-target],[data-count]').forEach(el => cntObs.observe(el));

        /* ── Notices data & render ── */
        const notices = [
            { d: '21 Apr 2026', title: 'Registration is open for IP & FE Exam — Spring Session 2026. Deadline: March 31.', cat: 'exam' },
            { d: '14 Apr 2026', title: 'Free 30-hour online FE preparation training commences October 4, 2025. All FE registrants eligible.', cat: 'general' },
            { d: '10 Mar 2026', title: 'IP Exam Result for October 2024 session published. Download from Results page.', cat: 'result' },
            { d: '18 Feb 2026', title: 'Certificate collection schedule announced for October 2024 passers — visit BCC Agargaon.', cat: 'general' },
            { d: '05 Jan 2026', title: 'Admit cards for Spring 2026 available for download from registration portal.', cat: 'exam' },
            { d: '01 Dec 2025', title: 'FE Half Passer list updated for October 2025 session. Check your registration portal.', cat: 'result' },
        ];

        const catStyle = {
            exam: { cls: 'nc-exam', label: 'Exam' },
            result: { cls: 'nc-result', label: 'Result' },
            general: { cls: 'nc-general', label: 'General' },
        };

        function renderNotices(filter) {
            const list = document.getElementById('notice-list');
            const data = filter === 'all' ? notices : notices.filter(n => n.cat === filter);
            list.innerHTML = data.map(n => `
    <div class="notice-row">
      <div class="notice-icon-box">
        <span class="ms" style="font-size:17px;color:#6366f1">event_note</span>
      </div>
      <div style="flex:1">
        <div style="display:flex;align-items:center;gap:8px;margin-bottom:5px;flex-wrap:wrap">
          <span class="notice-cat ${catStyle[n.cat].cls}">${catStyle[n.cat].label}</span>
          <span style="color:#94a3b8;font-size:11.5px">${n.d}</span>
        </div>
        <div style="font-size:13.5px;color:#1e293b;font-weight:500;line-height:1.5">${n.title}</div>
      </div>
      <span class="ms" style="font-size:18px;color:#e2e8f0;flex-shrink:0;margin-top:4px">chevron_right</span>
    </div>
  `).join('');
        }
        renderNotices('all');

        /* ── Tab filter ── */
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.tab-btn').forEach(b => {
                    b.classList.remove('active');
                });
                btn.classList.add('active');
                renderNotices(btn.dataset.filter);
            });
        });

        /* ── Hero stat bar quick counter ── */
        document.querySelectorAll('.hero-stat-val[data-count]').forEach(el => {
            const t = parseInt(el.dataset.count);
            if (!isNaN(t)) countUp(el, t, 1400);
        });
    </script>
</body>

</html>
