class Node {
	constructor(element) {
		this.element = element;
		this.next = null;
	}
}
class LinkedList {
	constructor() {
		this.head = null;
		this.size = 0;
	}
	add(element) {
		var node = new Node(element);
		var current;
		if (this.head == null)
			this.head = node;
		else {
			current = this.head;
			while (current.next) {
				current = current.next;
			}
			current.next = node;
		}
		this.size++;
	}
}
var dressList = new LinkedList();
var passedArray;
$(document).ready( function() {
    $('#prev').click(function() {
        $.ajax({
            type: 'POST',
            url: '../../web/get.php',
            data: 'id=testdata',
            dataType: 'json',
            cache: false,
            success: function(result) {
                var arrayLength = result.length;
				for (var i = 0; i < arrayLength; i++) {
					dressList.add(result[i]);
					console.log("Dress: "+result[i]);
				}
            },
        });
    });
});
//var passedArray = <?php echo json_encode($dressArray); ?>;
//var arrayLength = passedArray.length;
//for (var i = 0; i < arrayLength; i++) {
//	dressList.add(passedArray[i]);
//	console.log("Dress: "+passedArray[i]);
//}
//dressList.add("https://realdress.s3-us-west-1.amazonaws.com/user_uploads/dress1S.png");
//dressList.add("https://realdress.s3-us-west-1.amazonaws.com/user_uploads/dress2S.png");
//dressList.add("https://realdress.s3-us-west-1.amazonaws.com/user_uploads/dress3.png");

var curr = dressList.head;

function changeDress() {
	document.getElementById("clothes").style.backgroundImage = "url(" + curr.element + ")";
	if (curr.next != null) {
		curr = curr.next;
	} else {
		curr = dressList.head;
	}
}