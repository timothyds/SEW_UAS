<div class="container-fluid">
	<form action="" id="manage-schedule">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="col-lg-16">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="control-label">Faculty</label>
						<select name="faculty_id" id="" class="custom-select select2">
							<option value="0">All</option>
						<?php 
							$faculty = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM faculty order by concat(lastname,', ',firstname,' ',middlename) asc");
							while($row= $faculty->fetch_array()):
						?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($faculty_id) && $faculty_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['name']) ?></option>
						<?php endwhile; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="" class="control-label">Title</label>
						<textarea class="form-control" name="title" cols="30" rows="3"><?php echo isset($title) ? $title : '' ?></textarea>
					</div>
					<div class="form-group">
						<label for="" class="control-label">Schedule Type</label>
						<select name="schedule_type" id="" class="custom-select">
							<option value="1" <?php echo isset($schedule_type) && $schedule_type == 1 ? 'selected' : ''  ?>>Class</option>
							<option value="2" <?php echo isset($schedule_type) && $schedule_type == 2 ? 'selected' : ''  ?>>Meeting</option>
							<option value="3" <?php echo isset($schedule_type) && $schedule_type == 3 ? 'selected' : ''  ?>>Others</option>
						</select>
					</div>
					<div class="form-group">
						<label for="" class="control-label">Description</label>
						<textarea class="form-control" name="description" cols="30" rows="3"><?php echo isset($description) ? $description : '' ?></textarea>
					</div>
					<div class="form-group">
						<label for="" class="control-label">Location</label>
						<textarea class="form-control" name="location" cols="30" rows="3"><?php echo isset($location) ? $location : '' ?></textarea>
					</div>
					<div class="form-group">
						<div class="form-check">
						  <input class="form-check-input" type="checkbox" value="1" id="is_repeating" name="is_repeating" <?php echo isset($is_repeating) && $is_repeating != 1 ? '' : 'checked' ?>>
						  <label class="form-check-label" for="type">
						   	Weekly Schedule
						  </label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group for-repeating">
						<label for="dow" class="control-label">Days of Week</label>
						<select name="dow[]" id="dow" class="custom-select select2" multiple="multiple">
							<?php 
							$dow = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
							for($i = 0; $i < 7;$i++):
							?>
							<option value="<?php echo $i ?>"  <?php echo isset($dow_arr) && in_array($i,$dow_arr) ? 'selected' : ''  ?>><?php echo $dow[$i] ?></option>
						<?php endfor; ?>
						</select>
					</div>
					<div class="form-group for-repeating">
						<label for="" class="control-label">Month From</label>
						<input type="month" name="month_from" id="month_from" class="form-control" value="<?php echo isset($start) ? date("Y-m",strtotime($start)) : '' ?>">
					</div>
					<div class="form-group for-repeating">
						<label for="" class="control-label">Month To</label>
						<input type="month" name="month_to" id="month_to" class="form-control" value="<?php echo isset($end) ? date("Y-m",strtotime($end)) : '' ?>">
					</div>
					<div class="form-group for-nonrepeating" style="display: none">
						<label for="" class="control-label">Schedule Date</label>
						<input type="date" name="schedule_date" id="schedule_date" class="form-control" value="<?php echo isset($schedule_date) ? $schedule_date : '' ?>">
					</div>
					<div class="form-group">
						<label for="" class="control-label">Time From</label>
						<input type="time" name="time_from" id="time_from" class="form-control" value="<?php echo isset($time_from) ? $time_from : '' ?>">
					</div>
					<div class="form-group">
						<label for="" class="control-label">Time To</label>
						<input type="time" name="time_to" id="time_to" class="form-control" value="<?php echo isset($time_to) ? $time_to : '' ?>">
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="imgF" style="display: none " id="img-clone">
			<span class="rem badge badge-primary" onclick="rem_func($(this))"><i class="fa fa-times"></i></span>
	</div>