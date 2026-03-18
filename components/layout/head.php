<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= isset($siteName) ? $siteName : 'Comedy Club' ?></title>

  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Montserrat', 'sans-serif'],
          },
          colors: {
            orange: { DEFAULT: '#F15A29' },
          }
        }
      }
    }
  </script>

  <!-- Base layer styles: defaults that Tailwind utilities can override without !important -->
  <style type="text/tailwindcss">
    @layer base {
      h1, h2, h3, h4, h5, h6 {
        font-weight: 700;
      }
      button,
      a[class*="font-bold"][class*="px-"] {
        border-radius: 10px;
      }
      a.cc-tab-btn {
        border-radius: 5px;
      }
    }
  </style>

  <!-- Alpine.js -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3/dist/cdn.min.js"></script>

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <!-- Custom Styles -->
  <link rel="stylesheet" href="css/custom.css" />

  <script>
    document.addEventListener('DOMContentLoaded', () => { lucide.createIcons(); });
  </script>
</head>
