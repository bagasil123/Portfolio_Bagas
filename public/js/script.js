// Welcome screen functionality
function enterSite() {
    const welcomeScreen = document.getElementById('welcomeScreen');
    const header = document.getElementById('header');
    const mainContainer = document.getElementById('mainContainer');
    
    welcomeScreen.classList.add('hidden');
    
    setTimeout(() => {
        welcomeScreen.style.display = 'none';
        header.classList.add('visible');
        mainContainer.classList.add('visible');
    }, 1000);
}

// Custom cursor
const cursor = document.querySelector('.cursor');
let mouseX = 0, mouseY = 0;

document.addEventListener('mousemove', (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
});

function animateCursor() {
    cursor.style.left = mouseX + 'px';
    cursor.style.top = mouseY + 'px';
    requestAnimationFrame(animateCursor);
}
animateCursor();


// Enhanced Interactive background
const canvas = document.querySelector('.bg-canvas');
const ctx = canvas.getContext('2d');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const particles = [];
const particleCount = 100;
const connections = [];

// Create particles
for (let i = 0; i < particleCount; i++) {
    particles.push({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        vx: (Math.random() - 0.5) * 1,
        vy: (Math.random() - 0.5) * 1,
        size: Math.random() * 3 + 1,
        life: Math.random() * 100,
        maxLife: 100
    });
}

function drawParticles() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Draw particles
    for (let i = 0; i < particles.length; i++) {
        const p = particles[i];
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
        ctx.fillStyle = 'rgba(58, 168, 197, 0.7)';
        ctx.shadowColor = '#3aa8c5';
        ctx.shadowBlur = 10;
        ctx.fill();
        ctx.closePath();
    }

    // Draw connections
    for (let i = 0; i < particles.length; i++) {
        for (let j = i + 1; j < particles.length; j++) {
            const p1 = particles[i];
            const p2 = particles[j];
            const dist = Math.hypot(p1.x - p2.x, p1.y - p2.y);
            if (dist < 120) {
                ctx.beginPath();
                ctx.moveTo(p1.x, p1.y);
                ctx.lineTo(p2.x, p2.y);
                ctx.strokeStyle = 'rgba(58, 168, 197,' + (1 - dist / 120) * 0.3 + ')';
                ctx.lineWidth = 1;
                ctx.stroke();
                ctx.closePath();
            }
        }
    }
}

function updateParticles() {
    for (let i = 0; i < particles.length; i++) {
        const p = particles[i];
        p.x += p.vx;
        p.y += p.vy;
        p.life++;
        if (p.x < 0 || p.x > canvas.width) p.vx *= -1;
        if (p.y < 0 || p.y > canvas.height) p.vy *= -1;
        if (p.life > p.maxLife) {
            // Respawn particle
            p.x = Math.random() * canvas.width;
            p.y = Math.random() * canvas.height;
            p.vx = (Math.random() - 0.5) * 1;
            p.vy = (Math.random() - 0.5) * 1;
            p.size = Math.random() * 3 + 1;
            p.life = 0;
            p.maxLife = 100 + Math.random() * 100;
        }
    }
}

function animateBackground() {
    drawParticles();
    updateParticles();
    requestAnimationFrame(animateBackground);
}
animateBackground();

// Responsive canvas
window.addEventListener('resize', () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
});

// Fade-in animation on scroll
function revealOnScroll() {
    const fadeEls = document.querySelectorAll('.fade-in');
    const windowHeight = window.innerHeight;
    fadeEls.forEach(el => {
        const rect = el.getBoundingClientRect();
        if (rect.top < windowHeight - 60) {
            el.classList.add('visible');
        }
    });
}
window.addEventListener('scroll', revealOnScroll);
window.addEventListener('load', revealOnScroll);
