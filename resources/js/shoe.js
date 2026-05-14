import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

const container = document.getElementById('shoe-container');

if (container) {
    const scene = new THREE.Scene();
    scene.background = null;

    const camera = new THREE.PerspectiveCamera(
        45,
        container.clientWidth / container.clientHeight,
        0.1,
        1000
    );

    camera.position.set(2, 1.5, 4);

    const renderer = new THREE.WebGLRenderer({
        antialias: true,
        alpha: true
    });

    renderer.setSize(
        container.clientWidth,
        container.clientHeight
    );

    renderer.setPixelRatio(window.devicePixelRatio);

    container.appendChild(renderer.domElement);

    // Lights
    const ambientLight = new THREE.AmbientLight(
        0xffffff,
        2
    );
    scene.add(ambientLight);

    const directionalLight =
        new THREE.DirectionalLight(
            0xffffff,
            3
        );

    directionalLight.position.set(5, 5, 5);
    scene.add(directionalLight);

    // Controls
    const controls = new OrbitControls(
        camera,
        renderer.domElement
    );

    controls.enableDamping = true;
    controls.enableZoom = false;

    // Load Model
    const loader = new GLTFLoader();

    let shoe;

    loader.load(
        '/models/MaterialsVariantsShoe.glb',

        function (gltf) {
            shoe = gltf.scene;

            shoe.scale.set(10, 10, 10);
            shoe.position.y = -0.5;

            scene.add(shoe);
        },

        undefined,

        function (error) {
            console.error(error);
        }
    );

    // Animation
    function animate(time) {
        requestAnimationFrame(animate);

        if (shoe) {
            // Walking animation
            shoe.rotation.z =
                Math.sin(time * 0.005) * 0.08;

            shoe.rotation.x =
                Math.sin(time * 0.005) * 0.05;

            shoe.position.y =
                Math.abs(
                    Math.sin(time * 0.005)
                ) *
                    0.08 -
                0.5;

            // slight movement
            shoe.rotation.y += 0.003;
        }

        controls.update();
        renderer.render(scene, camera);
    }

    animate();

    // Resize
    window.addEventListener(
        'resize',
        () => {
            camera.aspect =
                container.clientWidth /
                container.clientHeight;

            camera.updateProjectionMatrix();

            renderer.setSize(
                container.clientWidth,
                container.clientHeight
            );
        }
    );
}
