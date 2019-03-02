var xhttp = null;

function keyUpFunc(e, cancelBtn, submitBtn) {
  console.log(e);
    console.log(e.keyCode);
    if (e.keyCode === 13) {
      submitBtn.click();
    } else if (e.keyCode === 27) {
      cancelBtn.click();
    }
    // cancelBtn.removeEventListener('click', keyUpFunc);
    // submitBtn.removeEventListener('click', keyUpFunc);
}