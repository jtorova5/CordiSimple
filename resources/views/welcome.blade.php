<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <title>CordiSimple</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom right, #1a202c, #2d3748, #000000);
            color: white;
            overflow: hidden;
        }

        .dashboard {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        #particleCanvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.3;
        }

        .content {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 20px;
        }

        .img-logo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin: 0 auto 1rem;
            display: block;
        }

        h1 {
            font-size: 4rem;
            margin-bottom: 0.5rem;
            position: relative;
            display: inline-block;
            color: #30D5C8;
            text-shadow: 0 0 10px rgba(48, 213, 200, 0.5);
            animation: pulsate 2s ease-in-out infinite;
        }

        @keyframes pulsate {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .slogan {
            font-size: 1.5rem;
            color: rgba(48, 213, 200, 0.9);
            margin-bottom: 2rem;
        }

        .buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border: none;
            border-radius: 9999px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-outline {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(48, 213, 200, 0.3);
            backdrop-filter: blur(4px);
        }

        .btn-outline:hover {
            background-color: rgba(48, 213, 200, 0.2);
        }

        .btn-primary {
            background-color: #30D5C8;
            color: #1a202c;
        }

        .btn-primary:hover {
            background-color: rgba(48, 213, 200, 0.9);
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 3rem;
            }

            .slogan {
                font-size: 1.25rem;
            }

            .buttons {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <canvas id="particleCanvas"></canvas>
        <div class="content">
            @if (Route::has('welcome'))
                <a href="{{ route('welcome') }}">
                    <img src="{{ asset('img/logo.webp') }}" alt="CordiSimple" class="img-logo">
                </a>
            @endif
            <h1>CordiSimple</h1>
            <p class="slogan">Get it simple</p>
            <div class="buttons">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" id="loginBtn" class="btn btn-outline">
                        Iniciar Sesión
                    </a>
                @endif

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" id="registerBtn" class="btn btn-primary">
                        Registrarse
                    </a>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Background particles animation
        (function() {
            const canvas = document.getElementById('particleCanvas');
            const ctx = canvas.getContext('2d');

            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;

            const particles = [];
            const particleCount = 100;

            class Particle {
                constructor() {
                    this.x = Math.random() * canvas.width;
                    this.y = Math.random() * canvas.height;
                    this.size = Math.random() * 3 + 1;
                    this.speedX = Math.random() * 3 - 1.5;
                    this.speedY = Math.random() * 3 - 1.5;
                    this.color = `rgba(48, 213, 200, ${Math.random() * 0.5})`;
                }

                update() {
                    this.x += this.speedX;
                    this.y += this.speedY;

                    if (this.x > canvas.width) this.x = 0;
                    else if (this.x < 0) this.x = canvas.width;

                    if (this.y > canvas.height) this.y = 0;
                    else if (this.y < 0) this.y = canvas.height;
                }

                draw() {
                    ctx.fillStyle = this.color;
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                    ctx.fill();
                }
            }

            function createParticles() {
                for (let i = 0; i < particleCount; i++) {
                    particles.push(new Particle());
                }
            }

            function animateParticles() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                for (let i = 0; i < particles.length; i++) {
                    particles[i].update();
                    particles[i].draw();
                }
                requestAnimationFrame(animateParticles);
            }

            createParticles();
            animateParticles();

            window.addEventListener('resize', () => {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
                createParticles();
            });
        })();
        // Title color animation
        const title = document.querySelector('h1');
        let hue = 180;
        setInterval(() => {
            hue = ((hue + 1) % 130) + 130;
            title.style.color = `hsl(${hue}, 100%, 50%)`;
            title.style.textShadow = `0 0 10px hsla(${hue}, 100%, 50%, 0.5)`;
        }, 50);
    </script>
</body>

</html>