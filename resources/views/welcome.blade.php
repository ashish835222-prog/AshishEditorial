<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashish Editorial | Extreme Post-Production Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        studioDark: '#080808',
                        studioCard: '#121212',
                        studioCyan: '#00E5FF',
                        studioGold: '#FFD700',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #080808; color: #ffffff; }
    </style>
</head>
<body class="overflow-x-hidden">

    <section class="relative min-h-screen flex items-center justify-center px-6 md:px-12 bg-gradient-to-b from-black via-studioDark to-studioDark">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-studioCyan/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-studioGold/10 rounded-full blur-[120px]"></div>

        <div class="max-w-7xl w-full grid grid-cols-1 lg:grid-cols-12 gap-12 items-center z-10">
            <div class="lg:col-span-7 space-y-6">
                <span class="text-xs uppercase tracking-[0.3em] text-studioCyan font-semibold px-3 py-1 bg-studioCyan/10 rounded-full border border-studioCyan/20">Studio Grade Assets</span>
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight leading-none text-white">
                    CREATIVE WORKFLOWS ON <span class="text-transparent bg-clip-text bg-gradient-to-r from-studioCyan to-studioGold">STEROIDS.</span>
                </h1>
                <p class="text-gray-400 text-lg max-w-xl">
                    Download premium cinematic LUTs, high-fidelity Premiere Pro project bundles, and automated wedding templates engineered by Ashish Editorial.
                </p>
                <div class="flex flex-wrap gap-4 pt-4">
                    <button onclick="openCheckoutModal(1)" class="px-8 py-4 bg-studioCyan text-black font-semibold rounded-lg hover:bg-white shadow-[0_0_30px_rgba(0,229,255,0.3)] transition-all duration-300 transform hover:-translate-y-1">
                        Buy Cinematic LUT Pack (₹299)
                    </button>
                    <a href="https://www.instagram.com/ashisheditorial/" target="_blank" class="px-8 py-4 bg-transparent text-white font-semibold rounded-lg border border-white/20 hover:bg-white/5 transition-all duration-300">
                        Follow on Instagram
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5 relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-studioCyan to-studioGold rounded-2xl blur opacity-30 group-hover:opacity-50 transition duration-1000"></div>
                <div class="relative bg-studioCard border border-white/10 p-4 rounded-2xl">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-3 h-3 bg-red-500/80 rounded-full"></span>
                        <span class="w-3 h-3 bg-yellow-500/80 rounded-full"></span>
                        <span class="w-3 h-3 bg-green-500/80 rounded-full"></span>
                        <span class="text-xs text-gray-500 ml-2">sony_a1_cinematic_preview.mp4</span>
                    </div>
                    <div class="w-full aspect-video bg-black rounded-lg flex items-center justify-center overflow-hidden border border-white/5 relative">
                        <div class="absolute text-center p-4">
                            <span class="text-sm text-studioCyan animate-pulse">● PLAYING CINEMATIC FEED</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="checkoutModal" class="fixed inset-0 bg-black/80 backdrop-blur-md hidden items-center justify-center z-50 p-4">
        <div class="bg-studioCard border border-white/10 w-full max-w-md rounded-2xl p-6 relative shadow-2xl">
            <button onclick="closeCheckoutModal()" class="absolute top-4 right-4 text-gray-400 hover:text-white font-bold text-lg">&times;</button>
            
            <div class="text-center space-y-2">
                <h3 id="modalProductTitle" class="text-xl font-bold text-white">Loading Asset...</h3>
                <p class="text-sm text-studioCyan font-mono">Amount Due: ₹<span id="modalProductPrice">0.00</span></p>
            </div>

            <div class="flex flex-col items-center justify-center my-6 p-4 bg-white rounded-xl max-w-[240px] mx-auto shadow-inner">
                <img id="dynamicQrImg" src="" alt="Scan to Pay" class="w-full h-auto hidden">
                <div id="qrLoader" class="text-black text-xs font-mono py-12 animate-pulse">GENERATING QR NODE...</div>
            </div>

            <p class="text-center text-xs text-gray-400 px-4 mb-4">
                Scan using Paytm, PhonePe, or GooglePay. Post payment, enter your 12-digit UTR/Ref number below.
            </p>

            <div class="space-y-3">
                <input type="hidden" id="formProductId">
                <div>
                    <label class="text-[11px] uppercase tracking-wider text-gray-400 block mb-1">Your Email Address</label>
                    <input type="email" id="customerEmail" placeholder="alex@gmail.com" class="w-full bg-black border border-white/10 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-studioCyan">
                </div>
                <div>
                    <label class="text-[11px] uppercase tracking-wider text-gray-400 block mb-1">12-Digit UPI Transaction UTR No.</label>
                    <input type="text" id="utrNumber" maxlength="12" placeholder="e.g., 329652110245" class="w-full bg-black border border-white/10 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-studioCyan font-mono">
                </div>
                <button onclick="submitUtrVerification()" class="w-full bg-studioCyan text-black font-bold py-3 rounded-lg hover:opacity-90 transition-all text-sm mt-2">
                    Submit UTR Reference
                </button>
            </div>
        </div>
    </div>

    <script>
        function openCheckoutModal(productId) {
            const modal = document.getElementById('checkoutModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // Reset Loader state
            document.getElementById('qrLoader').classList.remove('hidden');
            document.getElementById('dynamicQrImg').classList.add('hidden');

            // Call Laravel API dynamically to fetch generated code tracking nodes
            fetch(`/pay/upi/${productId}`)
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        document.getElementById('modalProductTitle').innerText = data.product_title;
                        document.getElementById('modalProductPrice').innerText = data.price;
                        document.getElementById('formProductId').value = productId;
                        
                        // Load image server string source
                        const qrImg = document.getElementById('dynamicQrImg');
                        qrImg.src = data.qr_image_url;
                        qrImg.classList.remove('hidden');
                        document.getElementById('qrLoader').classList.add('hidden');
                    }
                });
        }

        function closeCheckoutModal() {
            const modal = document.getElementById('checkoutModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        function submitUtrVerification() {
            const email = document.getElementById('customerEmail').value;
            const utr = document.getElementById('utrNumber').value;
            const productId = document.getElementById('formProductId').value;

            if(!email || utr.length !== 12) {
                alert('Bhai, please enter valid email and complete 12-digit UTR Number!');
                return;
            }

            // Post response wire mechanism back payload
            fetch('/pay/upi/verify', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: email, utr_number: utr, product_id: productId })
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                if(data.success) closeCheckoutModal();
            });
        }
    </script>
</body>
</html>