// Animation
function animate(time) {
    requestAnimationFrame(animate);

    if (shoe) {
        const walkSpeed = time * 0.008;

        // Walking sway (left/right tilt)
        shoe.rotation.z =
            Math.sin(walkSpeed) * 0.18;

        // Step motion (front/back tilt)
        shoe.rotation.x =
            Math.sin(walkSpeed) * 0.12;

        // Up/down bounce like stepping
        shoe.position.y =
            shoeBaseY +
            Math.abs(Math.sin(walkSpeed)) * 0.15;

        // Slight side movement
        shoe.position.x =
            Math.sin(walkSpeed) * 0.12;

        // Walking turn effect
        shoe.rotation.y =
            -0.4 + Math.sin(walkSpeed) * 0.08;
    }

    controls.update();
    renderer.render(scene, camera);
}

animate();