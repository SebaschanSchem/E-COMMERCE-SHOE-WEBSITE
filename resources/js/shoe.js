import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

const container = document.getElementById('shoe-container');

if (container) {
    if (!container.style.height && container.clientHeight === 0) {
        container.style.minHeight = '500px';
    }

    const scene = new THREE.Scene();
    scene.background = null;

    const camera = new THREE.PerspectiveCamera(
        45,
        container.clientWidth / container.clientHeight,
        0.1,
        1000
    );

    camera.position.set(0, 1.2, 4);

    const renderer = new THREE.WebGLRenderer({
        antialias: true,
        alpha: true
    });

    renderer.outputColorSpace = THREE.SRGBColorSpace;
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

    const hemisphereLight = new THREE.HemisphereLight(
        0xffffff,
        0x222222,
        2
    );
    scene.add(hemisphereLight);

    const directionalLight = new THREE.DirectionalLight(
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
    let shoeBaseY = 0;

    const fitModelToView = (model) => {
        const box = new THREE.Box3().setFromObject(model);
        const size = box.getSize(new THREE.Vector3());
        const center = box.getCenter(new THREE.Vector3());
        const maxDimension = Math.max(size.x, size.y, size.z);
        const targetSize = 2.8;
        const scale = maxDimension > 0 ? targetSize / maxDimension : 1;

        model.position.sub(center);
        model.scale.setScalar(scale);
        model.rotation.y = -0.4;

        const fittedBox = new THREE.Box3().setFromObject(model);
        const fittedSize = fittedBox.getSize(new THREE.Vector3());
        const distance = fittedSize.length() * 1.25;

        camera.position.set(0, fittedSize.y * 0.25, distance);
        camera.lookAt(0, 0, 0);

        controls.target.set(0, 0, 0);
        controls.update();
    };

    const showLoadError = () => {
        container.innerHTML = '<div class="flex h-full min-h-[300px] items-center justify-center text-sm text-red-600">3D shoe model failed to load.</div>';
    };

    loader.load(
        '/models/MaterialsVariantsShoe.glb',

        function (gltf) {
            shoe = gltf.scene;

            fitModelToView(shoe);
            shoeBaseY = shoe.position.y;

            scene.add(shoe);
        },

        undefined,

        function (error) {
            console.error(error);
            showLoadError();
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
                shoeBaseY +
                Math.abs(
                    Math.sin(time * 0.005)
                ) *
                0.08;

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
