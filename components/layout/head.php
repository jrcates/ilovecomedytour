<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= isset($siteName) ? $siteName : 'Comedy Break In' ?></title>

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
            red: { DEFAULT: '#d12027', light: '#e85a5f', lighter: '#f4a3a6', 50: '#fce8e8', dark: '#a91a20', darker: '#7f1318' },
            charcoal: { DEFAULT: '#383839', light: '#5a5a5b', lighter: '#8c8c8d', 50: '#e8e8e8' },
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
