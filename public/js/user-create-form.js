


// const signupForm = document.forms['signup-form'];
// 	const allInputFields = signupForm.querySelectorAll('input');
// 	const submitBtn = signupForm['submit-btn'];
// 	const passwordField = [...allInputFields].find(field => field.id === 'password-field');
// 	let typingTimer = null;

// 	const isFieldValid = field => field.id === 'password-confirm-field' ?
// 			field.value === passwordField.value : field.checkValidity();

// 	allInputFields.forEach(field => {
// 		const fieldSet = field.closest('.fieldset');

// 		field.addEventListener('focus', () => {
// 			fieldSet.classList.add('active');
// 			if (fieldSet.classList.contains('invalid')) {
//                 fieldSet.classList.add('has-error');
// 			}
// 		});

// 		field.addEventListener('blur', () => {
// 			if (!field.value.trim().length) {
// 				fieldSet.classList.remove('active');
// 			}
// 			fieldSet.classList.remove('has-error');
// 		});

// 		field.addEventListener('input', () => {
// 			if (field.value.trim().length === 0) {
//                 fieldSet.className = 'active';
//                 return;
// 			}

//             fieldSet.classList.add('typing');
//             clearTimeout(typingTimer);
// 			const isValid = isFieldValid(field);

//             if (isValid) {
//                 fieldSet.classList.add('valid');
//                 fieldSet.classList.remove('invalid');
//                 fieldSet.classList.remove('has-error');

//                 if ([...allInputFields].every(isFieldValid)) {
// 	                submitBtn.removeAttribute('disabled');
//                 }
//             } else {
// 	            if (fieldSet.classList.contains('has-error')) {
//                     fieldSet.classList.remove('typing');
// 	            }
//                 fieldSet.classList.remove('valid');
//                 fieldSet.classList.add('invalid');
// 	            submitBtn.setAttribute('disabled', 'disabled');
//             }

//             typingTimer = setTimeout(() => {
//                 fieldSet.classList.remove('typing');

//                 if (!isValid) {
//                     fieldSet.classList.add('has-error');
//                 }
//             }, 500);

// 		});
// 	});


