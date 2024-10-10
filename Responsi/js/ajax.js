function getXMLHttpRequest() {
  if (window.XMLHttpRequest) {
    //code for modern browser
    return new XMLHttpRequest();
  } else {
    //code for old IE browser
    return new ActiveXObject('Microsoft.XMLHTTP');
  }
}

const checkPhone = () => {
  let inner = 'error_phone_number';
  let phone_number = encodeURI(document.getElementById('phone_number').value);
  let url = './utils/get_order.php?phone_number=' + phone_number;

  // TODO: Cek apakah nomor telepon sudah digunakan dengan AJAX
};

const getModel = (brand_code) => {
  let inner = 'model';
  let url = './utils/get_model.php?brand_code=' + brand_code;

  // TODO: Ambil semua model yang disediakan oleh brand dengan AJAX
};

const addOrder = () => {
  const name = document.getElementById('name').value;
  const phone_number = document.getElementById('phone_number').value;
  const address = document.getElementById('address').value;
  const brand = document.getElementById('brand').value;
  const model = document.getElementById('model').value;
  const colorRadio = document.getElementsByName('color');

  let color;
  for (let i = 0; i < colorRadio.length; i++) {
    if (colorRadio[i].checked) {
      color = colorRadio[i].value;
      break;
    }
  }

  let xhr = getXMLHttpRequest();
  let url = './utils/add_order.php';
  let inner = 'form-status';
  let params =
    'name=' +
    name +
    '&phone=' +
    phone_number +
    '&address=' +
    address +
    '&brand=' +
    brand +
    '&model=' +
    model +
    '&color=' +
    color;

  // TODO: Lakukan request POST untuk menambahkan pesanan dengan AJAX.
  // Jika sukses, buat alert sukses
  // Jika gagal, buat alert gagal
};
