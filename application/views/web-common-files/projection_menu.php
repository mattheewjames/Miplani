<div class="col-md-12 border-bottom" id="bottom-header">
	<div class="row m-0 align-items-center">
		<div class="col-12">
			<div class="middel_right">
				<div class="text-center">
				 <?php
					$bg_view_class = 'blue-color-bg';
					$bg_new_class = 'blue-color-bg';
					$bg_viewfinancial_class = 'blue-color-bg';
					$bg_viewBiAnnual_class = 'blue-color-bg';
					$bg_viewQuarterly_class = 'blue-color-bg';
					$bg_createfinancial_class = 'blue-color-bg';
					$bg_createBiAnnual_class = 'blue-color-bg';
					$bg_createQuarterly_class = 'blue-color-bg';
					if(($this->router->class=='Projections' || $this->router->class=='projections') && $this->router->method=='NewProjection')
					{
						$bg_new_class = 'green-color-bg';
					}
					
					elseif(($this->router->class=='Projections' || $this->router->class=='projections') && $this->router->method=='index')
					{
						$bg_view_class = 'green-color-bg';
					}
					// echo "<pre>";
					// print_r($this->router->fetch_class());
					// print_r ($this->router->fetch_method());
					// echo "</pre>";
					?> 

					<a class="btn btn-info  <?php echo $bg_view_class;?>" href="<?php echo base_url('projections');?>">View my saved annual financial goals</a>
					<a class="btn btn-dark <?php echo $bg_new_class;?>" href="<?php echo base_url('projections/NewProjection');?>">Create new annual financial goal</a>
					<div class="dropdown btn p-0">
					 <button class="btn btn-info  dropdown-toggle blue-color-bg
					<?php if($this->router->fetch_class() == 'dreamProjection' && 
					$this->router->fetch_method()== 'index' ||
					$this->router->fetch_method()== 'Biannual' || 
					$this->router->fetch_method()== 'Quarterly') { echo 'green-color-bg';} ?>" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">View my saved dream financial goals</button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="<?php echo base_url('dreamProjection');?>">Your saved dream financial goal</a>
						<a class="dropdown-item" href="<?php echo base_url('dreamProjection/Biannual');?>">Your saved dream Bi-Annual goal</a>
						<a class="dropdown-item" href="<?php echo base_url('dreamProjection/Quarterly');?>">Your saved dream Quarterly goal
						</a>
 					  </div>
					</div>
					<div class="dropdown btn p-0">
					  <button class="btn btn-info dropdown-toggle blue-color-bg 
					<?php if($this->router->fetch_class() == 'dreamProjection' && 
					$this->router->fetch_method()== 'Create' ||
					$this->router->fetch_method()== 'CreateBiannualGoal' || 
					$this->router->fetch_method()== 'CreateQuarterlyGoal') { echo 'green-color-bg';} ?>" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Create new dream financial goal</button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="<?php echo base_url('dreamProjection/Create');?>">Create dream financial goal</a>
						<a class="dropdown-item" href="<?php echo base_url('dreamProjection/CreateBiannualGoal');?>">Create dream Bi-Annual goal</a>
						<a class="dropdown-item" href="<?php echo base_url('dreamProjection/CreateQuarterlyGoal');?>">Create dream Quarterly goal</a>
 					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>